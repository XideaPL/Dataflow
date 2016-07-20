<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Reader;

use Xidea\Dataflow\ReaderInterface;

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
     * @var string
     */
    protected $node;

    /*
     * 
     */
    public function __construct(\XMLReader $reader, array $options = array())
    {
        $this->reader = $reader;
        $this->node = isset($options['node']) ? $options['node'] : null;
    }
    
    /**
     * 
     * @param mixed $resource
     * @param array $options
     * 
     * @return ReaderInterface
     */
    public static function create($resource, array $options = array())
    {
        $reader = new \XMLReader();
        
        $reader->XML($resource);
        
        return new XmlReader($reader, $options);
    }
    
    /**
     * 
     * @param mixed $resource
     * @param array $options
     * 
     * @return ReaderInterface
     */
    public static function createFromFile($resource, array $options = array())
    {
        $reader = new \XMLReader();
        
        $reader->open($resource);
        
        return new XmlReader($reader, $options);
    }

    /**
     * @inheritDoc
     */
    public function read()
    {
        $reader = $this->reader;

        $result = [];
        $read = true;
        $opened = false;
        while ($read && $reader->read()) {
            if ($reader->nodeType == \XMLReader::ELEMENT && $reader->name == $this->node) {
                $opened = true;
            }

            if ($opened && $reader->nodeType == \XMLReader::ELEMENT) {
                $name = $reader->name;
            }

            if ($opened && ($reader->nodeType == \XMLReader::TEXT || $reader->nodeType == \XMLReader::CDATA)) {
                $result[$name] = $reader->value;
                $name = '';
            }

            if ($reader->nodeType == \XMLReader::END_ELEMENT && $reader->name == $this->node) {
                $read = false;
                $opened = false;
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        $this->reader->close();
    }

}
