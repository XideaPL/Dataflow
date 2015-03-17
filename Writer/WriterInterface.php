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
    /*
     * @param array $options
     */
    function configureOptions(array $options = []);
    
    /**
     * @param string $resource
     * 
     * @return bool
     */
    function open($resource, array $options = []);
    
    /**
     * @return bool
     */
    function write(array $fields = []);
    
    /**
     * @param bool
     */
    function close();
}