<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Reader;

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
    protected $node = 'product';
    
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
    public function open($resource, array $options = array())
    {
        $this->reader->open($resource);
    }
    
    public function read($fields = array())
    {
        $reader = $this->reader;
        $results = array();
        $counter = 0;
        while($reader->read()) {
            if($reader->nodeType == \XMLReader::ELEMENT && 
                $reader->name == $this->node)
            {
                    $results[$counter] = array();
            }
            
            if($reader->nodeType == \XMLReader::ELEMENT && in_array($reader->name, $fields)) {
                    $name = $reader->name;
            }
            
            if(isset($name) && $name && ($reader->nodeType == \XMLReader::TEXT || 
                $reader->nodeType == \XMLReader::CDATA))
            {
                    $results[$counter][$name] = $reader->value;
                    $name = '';
            }

            if($reader->nodeType == \XMLReader::END_ELEMENT && 
            $reader->name == $this->node)
            {
                    $counter++;
            }
        }
        
        return $results;
    }
    
    public function close()
    {
        $this->reader->close();
    }
}