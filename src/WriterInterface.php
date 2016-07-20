<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface WriterInterface
{
    /**
     * @param array
     * 
     * @return bool
     */
    function write($data);
    
    /**
     * @param bool
     */
    function close();
}