<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Export;

use Xidea\Component\Dataflow\Model\ExportInterface,
    Xidea\Component\Dataflow\Writer\WriterInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ExporterInterface
{
    /**
     * @param string $context
     * @param ServiceInterface $service
     */
    function addService($context, ServiceInterface $service);

    /**
     * Returns the service.
     *
     * @param string $context
     * 
     * @return ServiceInterface|null The service
     */
    function getService($context);
    
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
     * @param ExportInterface $export
     * @param \Closure|null $callback
     * 
     * @return bool
     */
    function process(ExportInterface $export, \Closure $callback = null);
}