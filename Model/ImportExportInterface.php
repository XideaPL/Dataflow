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
interface ImportExportInterface extends ProfileInterface
{    
    /**
     * Sets the file.
     * 
     * @param array $file
     */
    public function setFile($file);

    /**
     * Returns the file.
     *
     * @return array
     */
    public function getFile();
}
