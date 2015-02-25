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
     * Sets the context.
     * 
     * @param string $context
     */
    function setContext($context);

    /**
     * Returns the context.
     *
     * @return string
     */
    function getContext();
    
    /**
     * Sets the options.
     * 
     * @param array $options
     */
    function setOptions(array $options = array());

    /**
     * Returns the options.
     *
     * @return array
     */
    function getOptions();
    
    /**
     * Sets the option.
     * 
     * @param string $name
     * @param mixed $value
     */
    function setOption($name, $value);

    /**
     * Returns the option.
     *
     * @param string $name
     * @param mixed|null $default
     * 
     * @return mixed
     */
    function getOption($name, $default = null);
}
