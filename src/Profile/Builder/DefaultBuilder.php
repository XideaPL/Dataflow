<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Dataflow\Profile\Builder;

use Xidea\Dataflow\Profile\BuilderInterface;
use Xidea\Component\Base\Factory\ModelFactoryInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class DefaultBuilder implements BuilderInterface
{
    /**
     * Currently built profile.
     *
     * @var \Xidea\Dataflow\ProfileInterface
     */
    protected $profile;

    /**
     * Profile factory.
     *
     * @var ModelFactoryInterface
     */
    protected $factory;

    /*
     * 
     */
    public function __construct(ModelFactoryInterface $factory)
    {
        $this->factory = $factory;
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $this->profile = $this->factory->create();
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        $this->profile->setName($name);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFields(array $fields)
    {
        $this->profile->setFields($fields);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setSource(array $source)
    {
        $this->profile->setSource($source);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setTarget(array $target)
    {
        $this->profile->setTarget($target);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfile()
    {
        return $this->profile;
    }

}
