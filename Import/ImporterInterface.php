<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Import;

use Xidea\Component\Dataflow\Model\ImportInterface,
    Xidea\Component\Dataflow\Reader\ReaderInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ImporterInterface
{
    /**
     * @param string $context
     * @param ServiceInterface $service
     */
    public function addService($context, ServiceInterface $service);

    /**
     * Returns the service.
     *
     * @param string $context
     * 
     * @return ServiceInterface|null The service
     */
    public function getService($context);
    
    /**
     * @param string $type
     * @param ReaderInterface $reader
     */
    public function addReader($type, ReaderInterface $reader);

    /**
     * Returns the reader.
     *
     * @param string $type
     * 
     * @return ReaderInterface|null The reader
     */
    public function getReader($type);
    
    /**
     * @param ImportInterface $import
     */
    public function process(ImportInterface $import);
}