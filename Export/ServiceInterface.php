<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Export;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ServiceInterface
{
    /**
     * @return array
     */
    function getFields();
    
    /*
     * @return array
     */
    function getWriterFields();
    
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
     * @return array The export data
     */
    function export();
}