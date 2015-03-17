<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Import;

use Xidea\Component\Dataflow\Model\ImportInterface,
    Xidea\Component\Dataflow\Reader\ReaderInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ServiceInterface
{
    /**
     * @param ImportInterface $import
     */
    function setImport(ImportInterface $import);
    
    /**
     * @return ImportInterface The import model
     */
    function getImport();
    
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
     * @param ReaderInterface $reader
     * @param \Closure|null $readCallback
     */
    function import(ReaderInterface $reader, \Closure $readCallback = null);
}