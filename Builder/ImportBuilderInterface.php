<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Builder;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ImportBuilderInterface extends ProfileBuilderInterface
{
    /**
     * @param string
     */
    function setBehavior($behavior);
    
    /**
     * @param array
     */
    function setReader(array $reader);
    
    /**
     * @param array
     */
    function setFields(array $fields);
}