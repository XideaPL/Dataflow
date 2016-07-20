<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Writer\Factory;

use Xidea\Dataflow\Dataflow;
use Xidea\Dataflow\Writer\CsvWriter;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DefaultFactory
{
    /**
     * @inheritDoc
     */
    public static function createFromFile($type, $resource, array $options = array())
    {
        $writer = null;
        
        switch($type) {
            case Dataflow::TYPE_CSV:
                $writer = CsvWriter::createFromFile($resource, $options);
                break;
        }
        
        return $writer;
    }
}