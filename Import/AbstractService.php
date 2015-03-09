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
    
    public function getFields()
    {
        return $this->fields;
    }
    
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
    
    public function getReaderFields()
    {
        $fields = [];
        foreach($this->getFields() as $name => $config) {
            $fields[] = isset($config['alias']) ? $config['alias'] : $name;
        }
        return $fields;
    }
    
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
    
    public function configureOptions(array $options = [])
    {
        $this->options = array_merge([
           'behavior' => ImportInterface::BEHAVIOR_INSERT,
           'batch_size' => 50
        ], $options);
    }
    
    public function add(array $record)
    {
        foreach($this->fields as $name => $config) {
            if(isset($config['alias']) && array_key_exists($config['alias'], $record)) {
                $record[$name] = $record[$config['alias']];
            }
        }
        
        if($filteredRecord = $this->filter($record)) {
            $id = $filteredRecord[$this->getIdFieldName()];
            $this->data[$id] = $filteredRecord;
            
            return $filteredRecord;
        }
        
        return false;
    }
    
    public function import()
    {
        try {
            call_user_func_array([$this, $this->options['behavior']], [$this->options['batch_size']]);
        } catch(\Exception $e) {
            
        }
    }
    
    public function filter(array $record)
    {
        if(empty($record)) {
            return [];
        }
        
        return $record;
    }
}
