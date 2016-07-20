<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow;

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
     * @var array
     */
    protected $source;
    
    /*
     * @var array
     */
    protected $destination;
    
    /*
     * @var array
     */
    protected $fields = array();
    
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
    public function setSource(array $source)
    {
        $this->source = $source;
    }

    /**
     * @inheritDoc
     */
    public function getSource()
    {
        return $this->source;
    }
    
    /**
     * @inheritDoc
     */
    public function setDestination(array $destination)
    {
        $this->destination = $destination;
    }

    /**
     * @inheritDoc
     */
    public function getDestination()
    {
        return $this->destination;
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
}
