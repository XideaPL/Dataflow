<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow;

use Xidea\Component\Dataflow\Model\ProfileInterface,
    Xidea\Component\Dataflow\Reader\ReaderInterface,
    Xidea\Component\Dataflow\Writer\WriterInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface DataflowInterface
{  
    /**
     * @param ProfileInterface $profile
     */
    function setProfile(ProfileInterface $profile);
    
    /**
     * Returns the profile.

     * @return ProfileInterface|null The profile
     */
    function getProfile();
    
    /**
     * @param string $type
     * @param ReaderInterface $reader
     */
    function addReader($type, ReaderInterface $reader);

    /**
     * Returns the reader.
     *
     * @param string $type
     * 
     * @return ReaderInterface|null The reader
     */
    function getReader($type);
    
    /**
     * @param string $type
     * @param WriterInterface $writer
     */
    function addWriter($type, WriterInterface $writer);

    /**
     * Returns the writer.
     *
     * @param string $type
     * 
     * @return WriterInterface|null The writer
     */
    function getWriter($type);
    
    /**
     * @param \Closure|null $callback
     * 
     * @return bool
     */
    function process(\Closure $callback = null);
}