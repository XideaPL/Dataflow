<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Writer;

use Xidea\Dataflow\WriterInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class CsvWriter implements WriterInterface
{    
    /*
     * @var \SplFileObject
     */
    protected $writer;
    
    /*
     * @var string
     */
    protected $delimiter;
    
    /*
     * @var string
     */
    protected $enclosure;
    
    /*
     * 
     */
    public function __construct(\SplFileObject $writer, array $options = array())
    {
        $this->writer = $writer;
        
        $this->delimiter = isset($options['delimiter']) ? $options['delimiter'] : ',';
        $this->enclosure = isset($options['enclosure']) ? $options['enclosure'] : '"';
    }
    
    /**
     * 
     * @param mixed $resource
     * @param array $options
     * 
     * @return WriterInterface
     */
    public static function createFromFile($resource, array $options = array())
    {
        return new CsvWriter(new \SplFileObject($resource, 'w+'), $options);
    }

    /**
     * @inheritDoc
     */
    public function write($data)
    {
        return $this->writer->fputcsv($data, $this->delimiter, $this->enclosure);
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        $this->writer = null;
    }
}
