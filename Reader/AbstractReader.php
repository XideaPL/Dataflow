<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Reader;

use Xidea\Component\Dataflow\Reader\ReaderInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractReader implements ReaderInterface
{ 
    /*
     * @var array
     */
    protected $fields;
    
    /*
     * @var array
     */
    protected $options;

    /**
     * @inheritDoc
     */
    public function prepare($fields, array $options = [])
    {
        $this->fields = $fields;
        $this->options = array_merge($this->options, $options);
    }
    
    /**
     * @inheritDoc
     */
    public function getReaderFields()
    {
        $result = [];
        foreach($this->fields as $name => $config) {
            $key = isset($config['reader_alias']) ? $config['reader_alias'] : (isset($config['alias']) ? $config['alias'] : $name);
            $result[$key] = $name;
        }
        
        return $result;
    }
}
