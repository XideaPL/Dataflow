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
interface ResourceInterface extends ReaderInterface, WriterInterface
{    
    /**
     * Returns the type of data.
     * 
     * @return string
     */
    function getType();
    
    /**
     * Returns the source.
     *
     * @return \Xidea\Dataflow\Resource\Source\DataSourceInterface|\Xidea\Dataflow\Resource\Source\FileSourceInterface|null
     */
    function getSource();
    
    /**
     * Returns options of a resource
     * 
     * @return array
     */
    public function getOptions();
    
    /**
     * Closes the file connection.
     */
    function close();
}
