<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Reader;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ReaderInterface
{   
    /**
     * @return array
     */
    function getReaderFields();
    
    /**
     * @param array $options
     * 
     * @return bool
     */
    function prepare(array $options = []);
    
    /**
     * @return array
     */
    function read();
    
    /**
     * @return bool
     */
    function move(array $fields);
    
    /**
     * @param bool
     */
    function close();
}