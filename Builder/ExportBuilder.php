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
class ExportBuilder extends AbstractProfileBuilder implements ExportBuilderInterface
{
    /**
     * {@inheritdoc}
     */
    public function setWriter(array $writer)
    {
        $this->profile->setWriter($writer);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFields(array $fields)
    {
        $this->profile->setFields($fields);
    }
}
