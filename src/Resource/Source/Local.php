<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Resource\Source;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class Local implements FileSourceInterface
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
     * 
     */
    public function __construct($filename, $directory)
    {
        $this->filename = $filename;
        $this->directory = $directory;
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
        return $this->directory . '/' . $this->filename;
    }
    
    /**
     * @inheritDoc
     */
    public function isDownloadable()
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    public function read()
    {
        return file_get_contents($this->getPath());
    }
    
    /**
     * {@inheritDoc}
     */
    public function write($data)
    {
        return file_put_contents($this->getPath(), $data);
    }
    
    /**
     * {@inheritDoc}
     */
    public function close()
    {
        return;
    }
}
