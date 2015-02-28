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
     * @return string
     */
    function getIdField();
    
    /*
     * @param array $data
     */
    function import($data, array $options = array());
    
    /*
     * @param array $record
     */
    function filter(array $record);
}
