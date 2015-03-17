<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Builder;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ExportBuilderInterface extends ProfileBuilderInterface
{
    /**
     * @param array
     */
    function setWriter(array $writer);
    
    /**
     * @param array
     */
    function setFields(array $fields);
}
