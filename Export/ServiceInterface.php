<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Export;

use Xidea\Component\Dataflow\Model\ExportInterface,
    Xidea\Component\Dataflow\Writer\WriterInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ServiceInterface
{
        /**
     * @param ExportInterface $export
     */
    function setExport(ExportInterface $export);
    
    /**
     * @return ExportInterface The export model
     */
    function getExport();
    
    /**
     * @return array
     */
    function getFields();
    
    /**
     * @return string
     */
    function getIdFieldName();
    
    /*
     * @return void
     */
    function configureFields(array $fields = []);
    
    /*
     * @return void
     */
    function configureOptions(array $options = []);

    /*
     * @param WriterInterface $writer
     * @param \Closure|null $readCallback
     */
    function export(WriterInterface $writer, \Closure $writeCallback = null);
}