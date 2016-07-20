<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Operation;

use Xidea\Dataflow\OperationInterface;
use Xidea\Dataflow\Resource\FileResourceInterface;
use Xidea\Dataflow\Resource\FileResource;
use Xidea\Dataflow\Resource\Source\Local;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class Download implements OperationInterface
{
    /*
     * @var FileResourceInterface
     */
    protected $inResource;
    
    /*
     * @var string
     */
    protected $directory;
    
    /**
     * 
     * @param FileResourceInterface $inResource
     */
    public function __construct(FileResourceInterface $inResource, $directory)
    {
        $this->inResource = $inResource;
        $this->directory = $directory;
    }
    
    /**
     * @inheritDoc
     */
    public function process()
    {
        if(!$this->inResource instanceof \Xidea\Dataflow\Resource\FileResourceInterface) {
            throw new \InvalidArgumentException('Specify the file source to download it.');
        }
        
        $outSource = new Local($this->inResource->getFilename(), $this->directory);
        $outSource->write($this->inResource->getSource()->read());
        
        return new FileResource($this->inResource->getType(), $outSource, $this->inResource->getOptions());
    }
}