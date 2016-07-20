<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface DataflowInterface
{    
    /**
     * @param \Closure|null $callback
     * 
     * @return bool
     */
    function process($inResource, $outResource, \Closure $callback = null);
}