<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Resource;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractResource
{
    /*
     * @var string
     */
    protected $type;
    
    /*
     * @var Source\FileSourceInterface
     */
    protected $source;
    
    /*
     * @var \Xidea\Dataflow\ReaderInterface
     */
    protected $_reader;
    
    /*
     * @var \Xidea\Dataflow\WriterInterface
     */    
    protected $_writer;
    
    /*
     * @var array
     */
    protected $options = array();
  
    /*
     * 
     */
    public function __construct($type, array $options = array())
    {
        $this->type = $type;
        $this->options = $options;
    }
    
    /**
     * @inheritDoc
     */
    public function getType()
    {
        return $this->type;
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
    public function getOptions()
    {
        return $this->options;
    }
}
