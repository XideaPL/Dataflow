<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Writer;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface WriterInterface
{
    /**
     * @param array $fields
     * @param array $options
     * 
     * @return bool
     */
    function prepare($fields, array $options = []);
    
    /**
     * @return bool
     */
    function write($item);
    
    /**
     * @param bool
     */
    function close();
}