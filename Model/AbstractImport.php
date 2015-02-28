<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Model;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractImport extends AbstractProfile implements ImportInterface
{
    /**
     * @inheritDoc
     */
    public function setBehavior($behavior)
    {
        $this->setOption('behavior', $behavior);
    }
    
    /**
     * @inheritDoc
     */
    public function getBehavior()
    {
        return $this->getOption('behavior');
    }
    
    /**
     * @inheritDoc
     */
    public function setReader($reader)
    {
        $this->setOption('reader', $reader);
    }

    /**
     * @inheritDoc
     */
    public function getReader()
    {
        return $this->getOption('reader');
    }
    
    /**
     * @inheritDoc
     */
    public function getReaderType()
    {
        $reader = $this->getOption('reader');
        
        return isset($reader['type']) ? $reader['type'] : null;
    }
}
