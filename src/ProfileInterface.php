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
interface ProfileInterface
{
    /**
     * Returns the dataflow id.
     * 
     * @return string The dataflow id
     */
    function getId();

    /**
     * Sets the name.
     * 
     * @param string $name
     */
    function setName($name);

    /**
     * Returns the name.
     *
     * @return string
     */
    function getName();
    
    /**
     * Sets the source.
     * 
     * @param array $source
     */
    function setSource(array $source);

    /**
     * Returns the source.
     *
     * @return array
     */
    function getSource();
    
    /**
     * Sets the destination.
     * 
     * @param array $destination
     */
    function setDestination(array $destination);

    /**
     * Returns the destination.
     *
     * @return array
     */
    function getDestination();
    
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
