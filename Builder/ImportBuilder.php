<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Builder;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ImportBuilder extends AbstractProfileBuilder implements ImportBuilderInterface
{
    /**
     * {@inheritdoc}
     */
    public function setBehavior($behavior)
    {
        $this->profile->setBehavior($behavior);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setReader(array $reader)
    {
        $this->profile->setReader($reader);
    }
}
