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
interface ImportInterface extends ProfileInterface
{
    const BEHAVIOR_INSERT = 'insert';
    const BEHAVIOR_UPDATE = 'update';
    const BEHAVIOR_INSERT_UPDATE = 'insert_update';
    
    /**
     * Sets the behavior.
     * 
     * @param string $behavior
     */
    function setBehavior($behavior);

    /**
     * Returns the behavior.
     *
     * @return string
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
    
    /**
     * Sets the fields.
     * 
     * @param array $fields
     */
    function setFields(array $fields);

    /**
     * Returns the fields.
     *
     * @return array
     */
    function getFields();
}
