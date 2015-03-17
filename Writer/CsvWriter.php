<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Writer;

use Xidea\Component\Dataflow\Writer\WriterInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class CsvWriter implements WriterInterface
{
    /*
     * @var \SplFileObject
     */
    protected $writer;
    
    /*
     * @var array
     */
    protected $options;
    
    /**
     * @inheritDoc
     */
    public function configureOptions(array $options = [])
    {
        $this->options = array_merge([
            'delimiter' => ',',
            'enclosure' => '"'
        ], $options);
    }

    /**
     * @inheritDoc
     */
    public function open($resource, array $options = [])
    {
        $this->configureOptions($options);

        $this->writer = new \SplFileObject($resource, 'w');
        
        return true;
    }

    /**
     * @inheritDoc
     */
    public function write(array $fields = [])
    {
        return $this->writer->fputcsv($fields, $this->options['delimiter'], $this->options['enclosure']);
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        return;
    }
}
