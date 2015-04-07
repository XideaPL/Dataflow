<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Export;

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
            if(isset($config['virtual'])) {
                $results[$name] = $config;
            } elseif(isset($this->fields[$name])) {
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
           'batch_size' => 50
        ], $options);
    }
    
    /**
     * @inheritDoc
     */
    public function getWriterFields()
    {
        $fields = [];
        foreach($this->getFields() as $name => $config) {
            $fields[] = isset($config['alias']) ? $config['alias'] : $name;
        }
        return $fields;
    }
}
