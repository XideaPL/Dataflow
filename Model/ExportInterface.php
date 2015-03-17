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
interface ExportInterface extends ProfileInterface
{
    /**
     * Sets the writer.
     * 
     * @param array $writer
     */
    function setWriter($writer);

    /**
     * Returns the writer.
     *
     * @return array
     */
    function getWriter();
    
    /**
     * @return string
     */
    function getWriterType();
    
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
