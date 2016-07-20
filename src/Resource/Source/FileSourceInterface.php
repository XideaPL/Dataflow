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
interface FileSourceInterface extends ReaderInterface, WriterInterface
{
    /**
     * Returns the filename.
     *
     * @return string
     */
    function getFilename();
    
    /**
     * Returns the path.
     *
     * @return string
     */
    function getPath();
    
    /**
     * Returns whether a file is downloadable.
     * 
     * @return boolean
     */
    function isDownloadable();
    
    /**
     * Closes the source.
     */
    function close();
}
