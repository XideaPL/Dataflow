<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Reader;

use Xidea\Component\Dataflow\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class CsvReader extends AbstractReader
{    
    /*
     * @var \SplFileObject
     */
    protected $reader;
    
    /*
     * @var array
     */
    protected $headers = array();
    
    /*
     * @var int
     */
    protected $headersCount = 0;
    
    /**
     * 
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        parent::__construct($configuration);
        
        $this->options = [
            'delimiter' => ',',
            'enclosure' => '"',
            'headers' => true
        ];
    }

    /**
     * @inheritDoc
     */
    public function prepare($fields, array $options = [])
    {
        parent::prepare($fields, $options);

        if(isset($this->options['file']) && $this->options['file']) {
            $file = $this->configuration->getFilePath($this->options['file']);
            $this->reader = new \SplFileObject($file, 'r');
            
            if($this->options['headers']) {
                $this->reader->rewind();
                $this->headers = $this->reader->fgetcsv($this->options['delimiter'], $this->options['enclosure']);
                $this->headersCount = count($this->headers);
                $this->reader->next();
            }
            
            return true;
        }
        
        return false;
    }

    /**
     * @inheritDoc
     */
    public function read()
    {
        $result = $data = $this->reader->fgetcsv($this->options['delimiter'], $this->options['enclosure']);

        if($this->headersCount) {
            $result = [];
            for($i = 0; $i < $this->headersCount; $i++) {
                $result[$this->headers[$i]] = $data[$i];
            }
        }
        
        return $result;
    }
    
    /**
     * @inheritDoc
     */
    public function move(array $fields)
    {
        ;
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        return;
    }
}
