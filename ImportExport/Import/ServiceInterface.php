<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\ImportExport\Import;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ServiceInterface
{
    /**
     * @return array
     */
    public function getTags();
}
