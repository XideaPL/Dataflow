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
abstract class AbstractImport extends AbstractImportExport implements ImportInterface
{
    /*
     * @var string
     */
    protected $readerType;
    
    /**
     * @inheritDoc
     */
    public function setReaderType($type)
    {
        $this->setOption('reader_type', $type);
    }
    
    /**
     * @inheritDoc
     */
    public function getReaderType()
    {
        return $this->getOption('reader_type');
    }
}
