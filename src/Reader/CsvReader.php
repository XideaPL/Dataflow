<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Reader;

use Xidea\Dataflow\ReaderInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class CsvReader implements ReaderInterface
{    
    /*
     * @var \SplFileObject
     */
    protected $reader;
    
    /*
     * @var string
     */
    protected $delimiter;
    
    /*
     * @var string
     */
    protected $enclosure;
    
    /*
     * @var boolean
     */
    protected $hasHeaders;
    
    /*
     * @var array
     */
    protected $headers = array();
    
    /*
     * @var int
     */
    protected $headersCount = 0;
    
    /*
     * 
     */
    public function __construct(\SplFileObject $reader, array $options = array())
    {
        $this->reader = $reader;
        
        $this->delimiter = isset($options['delimiter']) ? $options['delimiter'] : ',';
        $this->enclosure = isset($options['enclosure']) ? $options['enclosure'] : '"';
        $this->hasHeaders = isset($options['hasHeaders']) ? $options['hasHeaders'] : false;
        
        if($this->hasHeaders) {
            $this->headers = $this->reader->fgetcsv($this->delimiter, $this->enclosure);
            $this->headersCount = count($this->headers);
            $this->reader->next();
        }
    }
    
    /**
     * 
     * @param mixed $resource
     * @param array $options
     * 
     * @return ReaderInterface
     */
    public static function createFromFile($resource, array $options = array())
    {
        return new CsvReader(new \SplFileObject($resource, 'w+'), $options);
    }

    /**
     * @inheritDoc
     */
    public function read()
    {
        $result = $data = $this->reader->fgetcsv($this->delimiter, $this->enclosure);

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
    public function close()
    {
        $this->reader = null;
    }
}
