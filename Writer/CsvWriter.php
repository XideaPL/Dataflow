<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Writer;

use Xidea\Component\Dataflow\Writer\WriterInterface,
    Xidea\Component\Dataflow\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class CsvWriter extends AbstractWriter
{    
    /*
     * @var \SplFileObject
     */
    protected $writer;
    
    /**
     * 
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        parent::__construct($configuration);
        
        $this->options = [
            'delimiter' => ',',
            'enclosure' => '"'
        ];
    }

    /**
     * @inheritDoc
     */
    public function prepare($fields, array $options = [])
    {
        parent::prepare($fields, $options);

        if(isset($this->options['file']) && $this->options['file']) {
            $file = $this->configuration->getFilePath($this->options['file']);
            if(!file_exists(dirname($file))) {
                mkdir(dirname($file), 0777, true);
            }
            $this->writer = new \SplFileObject($file, 'w');
            
            return true;
        }
        
        return false;
    }

    /**
     * @inheritDoc
     */
    public function write($item)
    {
        return $this->writer->fputcsv($this->convert($item), $this->options['delimiter'], $this->options['enclosure']);
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        return;
    }
}
