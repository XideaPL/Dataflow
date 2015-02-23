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
interface ImportInterface extends ImportExportInterface
{
    /**
     * @param string
     */
    function setReaderType($type);
    
    /**
     * @return string
     */
    function getReaderType();
}
