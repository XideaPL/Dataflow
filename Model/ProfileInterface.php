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
    public function getId();

    /**
     * Sets the name.
     * 
     * @param string $name
     */
    public function setName($name);

    /**
     * Returns the name.
     *
     * @return string
     */
    public function getName();
    
    /**
     * Sets the context.
     * 
     * @param string $context
     */
    public function setContext($context);

    /**
     * Returns the context.
     *
     * @return string
     */
    public function getContext();
    
    /**
     * Sets the direction.
     * 
     * @param string $direction
     */
    public function setDirection($direction);

    /**
     * Returns the direction.
     *
     * @return string
     */
    public function getDirection();
    
    /**
     * Sets the options.
     * 
     * @param array $options
     */
    public function setOptions(array $options = array());

    /**
     * Returns the options.
     *
     * @return array
     */
    public function getOptions();
    
    /**
     * Sets the option.
     * 
     * @param string $name
     * @param mixed $value
     */
    public function setOption($name, $value);

    /**
     * Returns the option.
     *
     * @param string $name
     * @param mixed|null $default
     * 
     * @return mixed
     */
    public function getOption($name, $default = null);
}
