<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Model;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ImportInterface extends ImportExportInterface
{
    const BEHAVIOR_INSERT = 1;
    const BEHAVIOR_UPDATE = 2;
    
    /**
     * Sets the behavior.
     * 
     * @param int $behavior
     */
    function setBehavior($behavior);

    /**
     * Returns the behavior.
     *
     * @return int
     */
    function getBehavior();
    
    /**
     * Sets the reader.
     * 
     * @param array $reader
     */
    function setReader($reader);

    /**
     * Returns the reader.
     *
     * @return array
     */
    function getReader();
    
    /**
     * @return string
     */
    function getReaderType();
}
