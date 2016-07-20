<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Resource;

use Xidea\Dataflow\Reader\Factory\DefaultFactory as ReaderFactory;
use Xidea\Dataflow\Writer\Factory\DefaultFactory as WriterFactory;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class FileResource extends AbstractResource implements FileResourceInterface
{    
    /*
     * 
     */
    public function __construct($type, Source\FileSourceInterface $source, $options = array())
    {
        parent::__construct($type, $options);
        
        $this->source = $source;
        
        $this->initReader();
        $this->initWriter();
    }
    
    /**
     * @inheritDoc
     */
    public function getFilename()
    {
        return $this->source->getFilename();
    }
    
    /**
     * @inheritDoc
     */
    public function getPath()
    {
        return $this->source->getPath();
    }
    
    /**
     * @inheritDoc
     */
    public function isDownloadable()
    {
        return $this->source->isDownloadable();
    }

    /**
     * @inheritDoc
     */
    public function read()
    {
        if($this->_reader) {
            return $this->_reader->read();
        }
        
        return $this->source->read();
    }
    
    /**
     * {@inheritDoc}
     */
    public function write($data)
    {
        if($this->_writer) {
            return $this->_writer->write($data);
        }
        
        return $this->source->write($data);
    }
    
    /**
     * {@inheritDoc}
     */
    public function close()
    {
        return $this->source->close();
    }
    
    /**
     * 
     */
    protected function initReader()
    {
        $this->_reader = ReaderFactory::createFromFile($this->getType(), $this->source->getPath(), $this->getOptions());
    }
    
    /**
     * 
     */
    protected function initWriter()
    {
        $this->_writer = WriterFactory::createFromFile($this->getType(), $this->source->getPath(), $this->getOptions());
    }
}
