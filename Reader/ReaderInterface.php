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
     * @param string $resource
     */
    function open($resource, array $options = array());
    
    /**
     * @return bool
     */
    function read($fields = array());
    
    /**
     * @param bool
     */
    function close();
}
