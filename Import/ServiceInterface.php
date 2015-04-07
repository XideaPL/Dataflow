<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Import;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ServiceInterface
{
    /**
     * @return array
     */
    function getFields();
    
    /**
     * @return array
     */
    function getReaderFields();
    
    /**
     * @return string
     */
    function getIdFieldName();
    
    /*
     * @return void
     */
    function configure(array $options = [], array $fields = []);
    
    /*
     * @return void
     */
    function configureFields(array $fields = []);
    
    /*
     * @return void
     */
    function configureOptions(array $options = []);
    
    /*
     * @param array $record
     * 
     * @return array The result
     */
    function add(array $record);
    
    /*
     * @param array $record
     * 
     * @return array The result
     */
    function filter(array $record);
    
    /*
     * @param array $record
     * 
     * @return array The result
     */
    function convert(array $record);

    /*
     * @param \Closure|null $callback
     */
    function import(\Closure $callback = null);
}