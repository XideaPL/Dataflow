<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Manager;

use Xidea\Component\Dataflow\Model\ImportInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ImportManagerInterface
{
    /**
     * Saves a import.
     * 
     * @param ImportInterface $import
     */
    function save(ImportInterface $import);

    /**
     * Updates a import.
     * 
     * @param ImportInterface $import
     */
    function update(ImportInterface $import);

    /**
     * Deletes a import.
     * 
     * @param ImportInterface $import
     */
    function delete(ImportInterface $import);
}
