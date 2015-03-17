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
abstract class AbstractExport extends AbstractProfile implements ExportInterface
{
    /*
     * @var array
     */
    protected $fields = array();
    
    /**
     * @inheritDoc
     */
    public function setWriter($writer)
    {
        $this->setOption('writer', $writer);
    }

    /**
     * @inheritDoc
     */
    public function getWriter()
    {
        return $this->getOption('writer');
    }
    
    /**
     * @inheritDoc
     */
    public function getWriterType()
    {
        $writer = $this->getOption('writer');
        
        return isset($writer['type']) ? $writer['type'] : null;
    }
    
    /**
     * @inheritDoc
     */
    public function setFields(array $fields)
    {
        $this->fields = $fields;
    }

    /**
     * @inheritDoc
     */
    public function getFields()
    {
        return $this->fields;
    }
}
