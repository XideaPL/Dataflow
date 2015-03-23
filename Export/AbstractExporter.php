<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Export;

use Xidea\Component\Dataflow\ConfigurationInterface,
    Xidea\Component\Dataflow\Writer\WriterInterface,  
    Xidea\Component\Dataflow\Model\ExportInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractExporter implements ExporterInterface
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
    protected $writers;
    
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
    public function addWriter($type, WriterInterface $writer)
    {
        $this->writers[$type] = $writer;
    }
    
    /**
     * @inheritDoc
     */
    public function getWriter($type)
    {
        return isset($this->writers[$type]) ? $this->writers[$type] : null;
    }
    
    /**
     * @inheritDoc
     */
    public function process(ExportInterface $export, \Closure $writeCallback = null)
    {
        $writer = $this->getWriter($export->getWriterType());
        $service = $this->getService($export->getContext());

        $file = $export->getFile();

        if(!empty($file)) {
            $filePath = $this->configuration->getFilePath($export->getFilePath());
            if(!file_exists(dirname($filePath))) {
                mkdir(dirname($filePath), 0777, true);
            }
            
            $writer->open($filePath, $export->getWriter());

            $service->setExport($export);
            $result = $service->export($writer, $writeCallback);
            
            $writer->close();
            
            return $result;
        }
        
        return false;
    }
}