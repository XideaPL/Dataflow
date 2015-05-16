<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Writer;

use Xidea\Component\Dataflow\Writer\AbstractWriter,
    Xidea\Component\Dataflow\ConfigurationInterface;
use Xidea\Component\Base\Doctrine\ORM\Manager\ModelManagerInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class DoctrineWriter extends AbstractWriter
{    
    /**
     * @var ModelManagerInterface
     */
    protected $entityManager;
    
    /**
     * @var int
     */
    protected $batchSize = 50;
    
    /**
     * @var int
     */
    protected $counter = 0;
    
    /**
     * 
     */
    public function __construct(ConfigurationInterface $configuration, ModelManagerInterface $entityManager)
    {
        parent::__construct($configuration);
        
        $this->entityManager = $entityManager;
        
        $this->entityManager->setFlushMode(false);
    }
    
    /**
     * @return object
     */
    abstract protected function createEntity();
    
    /**
     * @inheritDoc
     */
    public function write($item)
    {   
        $this->counter++;
        $item = $this->convert($item);
        
        $entity = $this->loadOrCreateEntity($item);
        $this->updateEntity($item, $entity);
        $this->saveEntity($entity);
        
        if(($this->counter % $this->batchSize) === 0) {
            $this->entityManager->flush();
            $this->entityManager->clear();
        }
    }
    
    /**
     * 
     */
    abstract protected function updateEntity($item, $entity);
    
    /**
     * 
     */
    abstract protected function saveEntity($entity);
    
    /**
     * 
     */
    abstract protected function loadOrCreateEntity($item);

    /**
     * 
     */
    protected function flushAndClear()
    {
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
    
    /**
     * @inheritDoc
     */
    public function close()
    {
        $this->flushAndClear();
    }
}
