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
interface FileInterface
{
    /**
     * Returns the file id.
     * 
     * @return string The file id
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
     * Sets the path.
     * 
     * @param string $path
     */
    function setPath($path);

    /**
     * Returns the path.
     *
     * @return string
     */
    function getPath();
}
