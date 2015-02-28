<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Import;

use Xidea\Component\Dataflow\ConfigurationInterface,
    Xidea\Component\Dataflow\Reader\ReaderInterface,  
    Xidea\Component\Dataflow\Model\ImportInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractImporter implements ImporterInterface
{
    /*
     * @var ConfigurationInterface
     */
    protected $configuration;
    
    /*
     * @var array
     */
    protected $services;
    
    /*
     * @var array
     */
    protected $readers;
    
    /*
     * 
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }
    
    /**
     * @inheritDoc
     */
    public function addService($context, ServiceInterface $service)
    {
        $this->services[$context] = $service;
    }
    
    /**
     * @inheritDoc
     */
    public function getService($context)
    {
        return isset($this->services[$context]) ? $this->services[$context] : null;
    }
    
    /**
     * @inheritDoc
     */
    public function addReader($type, ReaderInterface $reader)
    {
        $this->readers[$type] = $reader;
    }
    
    /**
     * @inheritDoc
     */
    public function getReader($type)
    {
        return isset($this->readers[$type]) ? $this->readers[$type] : null;
    }
    
    /**
     * @inheritDoc
     */
    public function process(ImportInterface $import, \Closure $readCallback = null)
    {
        $reader = $this->getReader($import->getReaderType());
        $service = $this->getService($import->getContext());
        
        $file = $import->getFile();
        
        if(!empty($file)) {
            $reader->open($this->configuration->getFilePath($import->getFilePath()), $import->getReader());

            while($record = $reader->read($service->getFields())) {
                if($service->add($record)) {
                    if(is_callable($readCallback)) {
                        $readCallback($record, $service);
                    }
                }
            }
            
            $reader->close();
            
            return $service->import();
        }
        
        return false;
    }
}