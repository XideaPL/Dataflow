<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Resource;

use Xidea\Dataflow\ResourceInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface DataResourceInterface extends ResourceInterface
{
    /**
     * Returns the batch size.
     *
     * @return int
     */
    function getBatchSize();
    
    /**
     * Returns whether data is collection of items.
     *
     * @return int
     */
    function isCollection();
}
