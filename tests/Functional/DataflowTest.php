<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Tests\Functional;

use Xidea\Dataflow\Dataflow;
use Xidea\Dataflow\Resource;
use Xidea\Dataflow\Resource\Source;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DataflowTest extends \PHPUnit_Framework_TestCase
{
    public function testProcessXmlToCsv()
    {
        $dataflow = new Dataflow();
        
        $xmlResource = new Resource\FileResource(Dataflow::TYPE_XML, new Source\Local('platon_24.xml', __DIR__.'/../../var/dataflow/in'), [
            'node' => 'product'
        ]);
        
        $csvResource = new Resource\FileResource(Dataflow::TYPE_CSV, new Source\Local('platon_24.csv', __DIR__.'/../../var/dataflow/out'));
        
        $this->assertEquals(true, $dataflow->process($xmlResource, $csvResource));
    }
}