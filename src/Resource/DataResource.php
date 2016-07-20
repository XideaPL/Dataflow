<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Resource;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DataResource extends AbstractResource implements DataResourceInterface
{    
    /*
     * 
     */
    public function __construct($type, Source\DataSourceInterface $source, $options = array())
    {
        parent::__construct($type, $options);
        
        $this->source = $source;
        
        $this->initReader();
        $this->initWriter();
    }
    
    /**
     * @inheritDoc
     */
    public function getBatchSize()
    {
        return $this->source->getBatchSize();
    }
    
    /**
     * @inheritDoc
     */
    public function isCollection()
    {
        return $this->source->isCollection();
    }

    /**
     * @inheritDoc
     */
    public function read()
    {
        return $this->source->read();
    }
    
    /**
     * {@inheritDoc}
     */
    public function write($data)
    {
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
