<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Resource\Source;

use Xidea\Dataflow\ReaderInterface;
use Xidea\Dataflow\WriterInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface DataSourceInterface extends ReaderInterface, WriterInterface
{
    /**
     * Returns the type of data.
     * 
     * @return string
     */
    function getType();
    
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
    
    /**
     * Closes the source.
     */
    function close();
}
