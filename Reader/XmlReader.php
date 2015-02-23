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
    protected $nodeType = 'product';
    
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
    public function open($resource, $options = array())
    {
        $this->reader->open($resource);
        
        if(isset($options['nodeType'])) {
            $this->nodeType = $options['nodeType'];
        }
    }
    
    public function read($tags = array())
    {
        $results = array();
        while($this->reader->next($this->nodeName)) {
            switch ($this->reader->nodeType) {
                case \XMLReader::TEXT:
                    $this->reader->read();
                    $results[] = $this->reader->value;
                    break;
                case \XmlReader::ELEMENT:
                    if(!empty($tags)) {
                        $data = array();
                        while ($this->reader->read()) {
                            if(in_array($this->reader->localName, $tags)) {
                                switch($this->reader->nodeType) {
                                    case \XmlReader::TEXT:
                                        $data[$this->reader->localName] = $this->reader->value;
                                        break;
                                    case \XmlReader::ELEMENT:
                                        $this->reader->read();
                                        $data[$this->reader->localName] = $this->reader->value;
                                        break;
                                }
                            }
                        }
                        $results[] = $data;
                    }
                    break;
                default:
                    break;
            }
        }
        
        return $results;
    }
    
    public function close()
    {
        $this->reader->close();
    }
}
