<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Import;

use Xidea\Component\Dataflow\Model\ImportInterface,
    Xidea\Component\Dataflow\Reader\ReaderInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractService implements ServiceInterface
{
    /**
     * @var ImportInterface
     */
    protected $import;
    
    /*
     * @var array
     */
    protected $fields;
    
    /*
     * var array
     */
    protected $data;
    
    /*
     * @var array
     */
    protected $options;
    
    /*
     * @var string
     */
    protected $idFieldName = null;
    
    /**
     * @inheritDoc
     */
    public function setImport(ImportInterface $import)
    {
        $this->import = $import;
        
        $this->configureOptions([
            'behavior' => $import->getBehavior()
        ]);
        $this->configureFields($import->getFields());
    }
    
    /**
     * @inheritDoc
     */
    public function getImport()
    {
        return $this->import;
    }
    
    /**
     * @inheritDoc
     */
    public function getFields()
    {
        return $this->fields;
    }
    
    /**
     * @inheritDoc
     */
    public function getIdFieldName()
    {
        if($this->idFieldName !== null) {
            return $this->idFieldName;
        }
        
        foreach($this->getFields() as $name => $config) {
            if(isset($config['id']) && $config['id']) {
                $this->idFieldName = $name;
            }
        }
        
        return $this->idFieldName;
    }
    
    /**
     * @inheritDoc
     */
    public function configureFields(array $fields = [])
    {
        if(empty($fields))
            return;
        
        $results = [];
        foreach($fields as $name => $config) {
            if(isset($this->fields[$name])) {
                $results[$name] = array_merge($this->fields[$name], $config);
            }
        }
        $this->fields = $results;
    }
    
    /**
     * @inheritDoc
     */
    public function configureOptions(array $options = [])
    {
        $this->options = array_merge([
           'behavior' => ImportInterface::BEHAVIOR_INSERT,
           'batch_size' => 50
        ], $options);
    }
    
    /**
     * @inheritDoc
     */
    public function import(ReaderInterface $reader, \Closure $readCallback = null)
    {
        try {
            $readerFields = $this->getReaderFields();
            while($record = $reader->read($readerFields)) {
                if($addedRecord = $this->add($record)) {
                    if(is_callable($readCallback)) {
                        $readCallback($addedRecord, $this);
                    }
                }
            }
            
            switch($this->options['behavior']) {
                case ImportInterface::BEHAVIOR_INSERT:
                    return $this->insert();
                case ImportInterface::BEHAVIOR_UPDATE:
                    return $this->update();
                case ImportInterface::BEHAVIOR_INSERT_UPDATE:
                    return $this->insertAndUpdate();
            }
        } catch(\Exception $e) {
            die($e->getMessage());
        }
        
        return false;
    }
    
    /**
     * @inheritDoc
     */
    protected function getReaderFields()
    {
        $fields = [];
        
        foreach($this->getFields() as $name => $config) {
            $fields[] = isset($config['alias']) ? $config['alias'] : $name;
        }
        return $fields;
    }
    
    /**
     * @inheritDoc
     */
    protected function filter(array $record)
    {
        if(empty($record)) {
            return [];
        }
        
        return $record;
    }
    
    /**
     * @inheritDoc
     */
    protected function add(array $record)
    {
        $data = [];
        
        foreach($this->fields as $name => $config) {
            if(array_key_exists($name, $record)) {
                $data[$name] = $record[$name];
            } elseif(isset($config['alias']) && array_key_exists($config['alias'], $record)) {
                $data[$name] = $record[$config['alias']];
            }
        }

        if($filteredRecord = $this->filter($data)) {
            $id = $filteredRecord[$this->getIdFieldName()];
            $this->data[$id] = $filteredRecord;
            
            return $filteredRecord;
        }
        
        return false;
    }
    
    /**
     * @return bool
     */
    abstract protected function insert();
    
    /**
     * @return bool
     */
    abstract protected function update();
    
    /**
     * @return bool
     */
    abstract protected function insertAndUpdate();
}