<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Profile;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface BuilderInterface
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
     * @param array
     */
    function setSource(array $source);
    
    /**
     * @param array
     */
    function setTarget(array $target);
    
    /**
     * @param array
     */
    function setFields(array $fields);
    
    /**
     * @return \Xidea\Dataflow\ProfileInterface
     */
    function getProfile();
}
