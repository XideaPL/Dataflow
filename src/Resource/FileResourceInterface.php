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
interface FileResourceInterface extends ResourceInterface
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
}
