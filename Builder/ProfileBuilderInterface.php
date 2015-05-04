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
interface ProfileBuilderInterface
{
    /**
     * @return void
     */
    function create();
    
    /**
     * @param string
     */
    function setName($name);
    
    /**
     * @param string
     */
    function setContext($context);
    
    /**
     * @param array
     */
    function setReader(array $reader);
    
    /**
     * @param array
     */
    function setWriter(array $writer);
    
    /**
     * @param array
     */
    function setFields(array $fields);
    
    /**
     * @return \Xidea\Component\Dataflow\Model\ProfileInterface
     */
    function getProfile();
}
