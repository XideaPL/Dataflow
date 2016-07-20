<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Resource\Source;

/**
 * @see https://github.com/KnpLabs/Gaufrette/blob/master/src/Gaufrette/Adapter/Ftp.php
 */
class Ftp implements FileSourceInterface
{    
    /*
     * @var string
     */
    protected $filename;
    
    /*
     * @var string
     */
    protected $directory;
    
    /*
     * @var string
     */
    protected $host;
    
    /*
     * @var resource
     */
    protected $connection = null;

    /*
     * @var int
     */
    protected $port;
    
    /*
     * @var string
     */
    protected $username;
    
    /*
     * @var string
     */
    protected $password;
    
    /*
     * @var boolean
     */
    protected $passive;
    
    /*
     * @var boolean
     */
    protected $ssl;
    
    /*
     * @var string
     */
    protected $mode;
    
    /*
     * 
     */
    public function __construct($filename, $directory, $host, $options = array())
    {
        $this->filename = $filename;
        $this->directory = $directory;
        $this->host      = $host;
        
        $this->port      = isset($options['port']) ? $options['port'] : 21;
        $this->username  = isset($options['username']) ? $options['username'] : null;
        $this->password  = isset($options['password']) ? $options['password'] : null;
        $this->passive   = isset($options['passive']) ? $options['passive'] : false;
        $this->ssl       = isset($options['ssl']) ? $options['ssl'] : false;
        $this->mode      = isset($options['mode']) ? $options['mode'] : FTP_BINARY;
    }
    
    /**
     * @inheritDoc
     */
    public function getFilename()
    {
        return $this->filename;
    }
    
    /**
     * @inheritDoc
     */
    public function getPath()
    {
        return rtrim($this->directory, '/') . '/' . $this->filename;
    }
    
    /**
     * @inheritDoc
     */
    public function isDownloadable()
    {
        return true;
    }

    /**
     * @inheritDoc
     */
    public function read()
    {
        $temp = fopen('php://temp', 'r+');
        
        if (!ftp_fget($this->getConnection(), $temp, $this->getPath(), $this->mode)) {
            return false;
        }
        
        rewind($temp);
        $contents = stream_get_contents($temp);
        fclose($temp);
        return $contents;
    }
    
    /**
     * {@inheritDoc}
     */
    public function write($data)
    {
        $path = $this->getPath();
        $directory = dirname($path);
        $temp = fopen('php://temp', 'r+');
        $size = fwrite($temp, $data);
        rewind($temp);
        if (!ftp_fput($this->getConnection(), $path, $temp, $this->mode)) {
            fclose($temp);
            return false;
        }
        fclose($temp);
        return $size;
    }
    
    /**
     * @return boolean
     */
    private function isConnected()
    {
        return is_resource($this->connection);
    }
    
    /**
     * @return resource
     */
    private function getConnection()
    {
        if (!$this->isConnected()) {
            $this->connect();
        }
        
        return $this->connection;
    }
    
    /**
     * @throws RuntimeException
     */
    private function connect()
    {
        // open ftp connection
        if (!$this->ssl) {
            $this->connection = ftp_connect($this->host, $this->port);
        } else {
            if(function_exists('ftp_ssl_connect')) {
                $this->connection = ftp_ssl_connect($this->host, $this->port);        
            } else {
                throw new \RuntimeException('This Server Has No SSL-FTP Available.');
            }
        }
        if (!$this->connection) {
            throw new \RuntimeException(sprintf('Could not connect to \'%s\' (port: %s).', $this->host, $this->port));
        }
        $username = $this->username ? : 'anonymous';
        $password = $this->password ? : '';
        // login ftp user
        if (!@ftp_login($this->connection, $username, $password)) {
            $this->close();
            throw new \RuntimeException(sprintf('Could not login as %s.', $username));
        }
        // switch to passive mode if needed
        if ($this->passive && !ftp_pasv($this->connection, true)) {
            $this->close();
            throw new \RuntimeException('Could not turn passive mode on.');
        }
        // ensure the adapter's directory exists
        if ('/' !== $this->directory) {
            try {
                $this->ensureDirectoryExists($this->directory, $this->create);
            } catch (\RuntimeException $e) {
                $this->close();
                throw $e;
            }
            // change the current directory for the adapter's directory
            if (!ftp_chdir($this->connection, $this->directory)) {
                $this->close();
                throw new \RuntimeException(sprintf('Could not change current directory for the \'%s\' directory.', $this->directory));
            }
        }
    }
    
    /**
     * Closes the adapter's ftp connection
     */
    public function close()
    {
        if ($this->isConnected()) {
            ftp_close($this->connection);
        }
    }
}
