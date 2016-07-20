<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow;

use Xidea\Dataflow\Resource\FileResourceInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class Dataflow implements DataflowInterface
{
    const TYPE_XML = 'xml';
    const TYPE_CSV = 'csv';
    const TYPE_ARRAY = 'array';
    const TYPE_SCALAR = 'scalar';
    const TYPE_OBJECT = 'object';
    
    /**
     * @inheritDoc
     */
    public function process($inResource, $outResource, \Closure $callback = null)
    {
        if($inResource instanceof FileResourceInterface && $inResource->isDownloadable()) {
            $download = new Operation\Download($inResource, __DIR__.'/../var/dataflow/in');
            $inResource = $download->process();
        }
        
        $counter = 1;
        
        $result = false;
        try {
            while ($data = $inResource->read()) {
                //TODO: manipulate data

                $outResource->write($data);

                if(is_callable($callback)) {
                    call_user_func_array($callback, array($counter, $data));
                }

                $counter++;
            }
            
            $result = true;
        } catch (\Exception $e) {
            die($e->getMessage());
        }
        
        $inResource->close();
        $outResource->close();
        
        return $result;
    }
}