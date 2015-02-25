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
abstract class AbstractImportExport extends AbstractProfile implements ImportExportInterface
{
    /**
     * @inheritDoc
     */
    public function setFile($file)
    {
        $this->setOption('file', $file);
    }

    /**
     * @inheritDoc
     */
    public function getFile()
    {
        return $this->getOption('file');
    }
    
    /**
     * @inheritDoc
     */
    public function getFilePath()
    {
        $file = $this->getFile();
        
        $filePath = isset($file['name']) ? $file['name'] : null;
        
        if($filePath && isset($file['path'])) {
            $filePath = sprintf('%s/%s', $file['path'], $filePath);
        }
        
        return $filepath;
    }
}
