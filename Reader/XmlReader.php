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
class XmlReader implements ReaderInterface
{
    /*
     * @var \XmlReader
     */
    protected $reader;
    
    /*
     * @var array
     */
    protected $options;

    /*
     * 
     */
    public function __construct()
    {
        $this->reader = new \XMLReader();
    }
    
    /**
     * @inheritDoc
     */
    public function configureOptions(array $options = [])
    {
        $this->options = array_merge([
           'node' => 'product'
        ], $options);
    }

    /**
     * @inheritDoc
     */
    public function open($resource, array $options = [])
    {
        $this->configureOptions($options);
        
        return $this->reader->open($resource);
    }

    /**
     * @inheritDoc
     */
    public function read(array $fields = [])
    {
        $reader = $this->reader;
        $node = $this->options['node'];
        
        $result = [];
        $read = true;
        while ($read && $reader->read()) {
            if ($reader->nodeType == \XMLReader::ELEMENT &&
                    $reader->name == $node) {
                $result = [];
            }

            if ($reader->nodeType == \XMLReader::ELEMENT && in_array($reader->name, $fields)) {
                $name = $reader->name;
            }

            if (isset($name) && $name && ($reader->nodeType == \XMLReader::TEXT ||
                    $reader->nodeType == \XMLReader::CDATA)) {
                $result[$name] = $reader->value;
                $name = '';
            }

            if ($reader->nodeType == \XMLReader::END_ELEMENT &&
                    $reader->name == $node) {
                $read = false;
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function move(array $fields)
    {
        $reader = $this->reader;
        $node = $this->options['node'];
        
        $fieldsNames = array_keys($fields);
        $fieldsCounter = count($fieldsNames);
        $counter = 0;
        
        $read = $fieldsCounter;
        while ($read && $reader->read()) {
            if ($reader->nodeType == \XMLReader::ELEMENT &&
                    $reader->name == $node) {
                $result = [];
            }

            if ($reader->nodeType == \XMLReader::ELEMENT && in_array($reader->name, $fieldsNames)) {
                $name = $reader->name;
            }

            if (isset($name) && $name && ($reader->nodeType == \XMLReader::TEXT ||
                    $reader->nodeType == \XMLReader::CDATA)) {
                if($fields[$name] == $reader->value) {
                    $result[$name] = $reader->value;
                    $counter++;
                    
                    $name = '';
                }
            }

            if ($reader->nodeType == \XMLReader::END_ELEMENT &&
                    $reader->name == $node) {
                $read = ($fieldsCounter != $counter);
            }
        }
        
        return $fieldsCounter == $counter;
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        $this->reader->close();
    }
}
