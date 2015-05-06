<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Model;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractProfile implements ProfileInterface
{
    /*
     * @var int
     */
    protected $id;
    
    /*
     * @var string
     */
    protected $name;
    
    /*
     * @var string
     */
    protected $context;
    
    /*
     * @var array
     */
    protected $fields = array();
    
    /*
     * @var array
     */
    protected $options;
    
    /**
     * @inheritDoc
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @inheritDoc
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * @inheritDoc
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * @inheritDoc
     */
    public function getContext()
    {
        return $this->context;
    }
    
    /**
     * @inheritDoc
     */
    public function setReader($reader)
    {
        $this->setOption('reader', $reader);
    }

    /**
     * @inheritDoc
     */
    public function getReader()
    {
        return $this->getOption('reader');
    }
    
    /**
     * @inheritDoc
     */
    public function setWriter($writer)
    {
        $this->setOption('writer', $writer);
    }

    /**
     * @inheritDoc
     */
    public function getWriter()
    {
        return $this->getOption('writer');
    }
    
    /**
     * @inheritDoc
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
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
    public function getFieldWithId()
    {
        foreach($this->getFields() as $name => $field) {
            if(isset($field['id']) && $field['id']) {
                return array($name, $field);
            }
        }
        
        return array();
    }
    
    /**
     * @inheritDoc
     */
    public function setOptions(array $options = array())
    {
        $this->options = $options;
    }
    
    /**
     * @inheritDoc
     */
    public function getOptions()
    {
        return $this->options;
    }
    
    /**
     * @inheritDoc
     */
    public function setOption($name, $value)
    {
        $this->options[$name] = $value;
    }
    
    /**
     * @inheritDoc
     */
    public function getOption($name, $default = null)
    {
        return isset($this->options[$name]) ? $this->options[$name] : $default;
    }
    
    /**
     * @inheritDoc
     */
    public function getFilePath()
    {
        $file = $this->getFile();
        
        $filePath = isset($file['name']) ? $file['name'] : null;
        
        if($filePath && isset($file['path'])) {
            $filePath = sprintf('%s/%s', $file['path'], $filePath);
        }
        
        return $filePath;
    }
}
