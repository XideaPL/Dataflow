<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Writer;

use Xidea\Component\Dataflow\Writer\WriterInterface,
    Xidea\Component\Dataflow\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractWriter implements WriterInterface
{
    /*
     * @var ConfigurationInterface
     */
    protected $configuration;
    
    /*
     * @var array
     */
    protected $fields;
    
    /*
     * @var array
     */
    protected $options = array();
    
    /**
     * 
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @inheritDoc
     */
    public function prepare($fields, array $options = [])
    {
        $this->fields = $fields;
        $this->options = array_merge($this->options, $options);
    }
    
    /*
     * @param array $item
     * 
     * @return array
     */
    protected function convert($item)
    {
        $result = [];
        foreach($this->fields as $name => $config) {
            $key = isset($config['writer_alias']) ? $config['writer_alias'] : (isset($config['alias']) ? $config['alias'] : $name);
            if(array_key_exists($name, $item)) {
                $result[$key] = $item[$name];
            }
        }
        
        return $result;
    }
}