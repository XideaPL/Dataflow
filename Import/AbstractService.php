<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Import;

use Xidea\Component\Dataflow\Model\ImportInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractService implements ServiceInterface
{    
    /*
     * @var array
     */
    protected $fields;
    
    /*
     * @var array
     */
    protected $options;
    
    /*
     * @var string
     */
    protected $idFieldName = null;
    
    /*
     * @var array
     */
    protected $data;
    
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
    public function getReaderFields()
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
    public function configure(array $options = [], array $fields = [])
    {
        $this->configureOptions($options);
        $this->configureFields($fields);
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
    public function add(array $record)
    {
        $record = $this->convert($record);
        if($filteredRecord = $this->filter($record)) {
            $this->data[] = $filteredRecord;
        }
    }
    
    /**
     * @inheritDoc
     */
    public function filter(array $record)
    {
        return $record;
    }
    
    /**
     * @inheritDoc
     */
    public function convert(array $record)
    {
        $idField = $this->getIdFieldName();
        
        $result = [];
        foreach($data as $record) {
            foreach($this->fields as $name => $config) {
                $id = isset($config[$idField]) ? $config[$idField] : $name;
                if(array_key_exists($name, $record)) {
                    $result[$id] = $record[$name];
                } elseif(isset($config['alias']) && array_key_exists($config['alias'], $record)) {
                    $result[$id] = $record[$config['alias']];
                }
            }
        }
        
        return $result;
    }
    
    /**
     * @inheritDoc
     */
    public function import(\Closure $callback = null)
    {
        try {
            switch($this->options['behavior']) {
                case ImportInterface::BEHAVIOR_INSERT:
                    return $this->insert($callback);
                case ImportInterface::BEHAVIOR_UPDATE:
                    return $this->update($callback);
                case ImportInterface::BEHAVIOR_INSERT_UPDATE:
                    return $this->insertAndUpdate($callback);
            }
        } catch(\Exception $e) {
            die($e->getMessage());
        }
        
        return false;
    }
    
    /**
     * @return bool
     */
    abstract protected function insert(\Closure $callback = null);
    
    /**
     * @return bool
     */
    abstract protected function update(\Closure $callback = null);
    
    /**
     * @return bool
     */
    abstract protected function insertAndUpdate(\Closure $callback = null);
}