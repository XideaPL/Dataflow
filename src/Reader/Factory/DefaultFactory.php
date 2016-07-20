<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Reader\Factory;

use Xidea\Dataflow\Dataflow;
use Xidea\Dataflow\Reader\XmlReader;
use Xidea\Dataflow\Reader\CsvReader;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DefaultFactory
{
    /**
     * @inheritDoc
     */
    public static function create($type, $resource, array $options = array())
    {
        $reader = null;
        
        switch($type) {
            case Dataflow::TYPE_XML:
                $reader = XmlReader::create($resource, $options);
                break;
        }
        
        return $reader;
    }
    
    /**
     * @inheritDoc
     */
    public static function createFromFile($type, $resource, array $options = array())
    {
        $reader = null;
        
        switch($type) {
            case Dataflow::TYPE_XML:
                $reader = XmlReader::createFromFile($resource, $options);
                break;
            case Dataflow::TYPE_CSV:
                $reader = CsvReader::createFromFile($resource, $options);
                break;
        }
        
        return $reader;
    }
}