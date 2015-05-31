<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license intypeion, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Reader;

use Xidea\Component\Dataflow\ConfigurationInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class CsvReader extends AbstractReader
{    
    /*
     * @var \SplFileObject
     */
    protected $reader;
    
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
            $this->reader = new \SplFileObject($file, 'r');
            
            return true;
        }
        
        return false;
    }

    /**
     * @inheritDoc
     */
    public function read()
    {
        return $this->reader->fgetcsv($this->options['delimiter'], $this->options['enclosure']);
    }
    
    /**
     * @inheritDoc
     */
    public function move(array $fields)
    {
        ;
    }

    /**
     * @inheritDoc
     */
    public function close()
    {
        return;
    }
}
