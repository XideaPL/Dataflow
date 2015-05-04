<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow;

use Xidea\Component\Dataflow\Model\ProfileInterface,
    Xidea\Component\Dataflow\Reader\ReaderInterface,
    Xidea\Component\Dataflow\Writer\WriterInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractDataflow implements DataflowInterface
{
    /*
     * @var ProfileInterface
     */
    protected $profile;
    
    /*
     * @var array
     */
    protected $readers;
    
    /*
     * @var array
     */
    protected $writers;
    
    /**
     * @inheritDoc
     */
    public function setProfile(ProfileInterface $profile)
    {
        $this->profile = $profile;
    }
    
    /**
     * @inheritDoc
     */
    public function getProfile()
    {
        return $this->profile;
    }
    
    /**
     * @inheritDoc
     */
    public function addReader($type, ReaderInterface $reader)
    {
        $this->readers[$type] = $reader;
    }
    
    /**
     * @inheritDoc
     */
    public function getReader($type)
    {
        return isset($this->readers[$type]) ? $this->readers[$type] : null;
    }
    
    /**
     * @inheritDoc
     */
    public function addWriter($type, WriterInterface $writer)
    {
        $this->writers[$type] = $writer;
    }
    
    /**
     * @inheritDoc
     */
    public function getWriter($type)
    {
        return isset($this->writers[$type]) ? $this->writers[$type] : null;
    }
    
    /**
     * @inheritDoc
     */
    public function process(\Closure $callback = null)
    {
        $profile = $this->getProfile();
        
        if(!$profile instanceof ProfileInterface) {
            throw new \LogicException();
        }
        
        $readerOptions = $profile->getReader();
        $writerOptions = $profile->getWriter();
        
        if(empty($readerOptions) || empty($writerOptions) || !isset($readerOptions['type']) || !isset($writerOptions['type'])) {
            throw new \LogicException();
        }
        
        $reader = $this->getReader($readerOptions['type']);
        $writer = $this->getWriter($writerOptions['type']);
        
        if(!($reader && $writer)) {
            throw new \LogicException();
        }
        
        try {
            $fields = $profile->getFields();
            $reader->prepare($fields, $readerOptions);
            $writer->prepare($fields, $writerOptions);

            $count = 0;
            while($row = $reader->read()) {
                $item = $this->filter($this->convert($item));
                $writer->write($item);
                
                if(is_callable($callback)) {
                    call_user_func_array($callback, array($count, $item));
                }
                
                $count++;
            }
            
            $reader->close();            
            $writer->close();
            
            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
        return false;
    }
    
    /**
     * @param array $item
     */
    protected function convert($item)
    {
        $profile = $this->getProfile();
        
        if(!$profile instanceof ProfileInterface) {
            throw new \LogicException();
        }
        
        return $item;
    }
    
    /**
     * @param array $item
     * 
     * @return array|null The result
     */
    protected function filter($item)
    {
        return $item;
    }
}