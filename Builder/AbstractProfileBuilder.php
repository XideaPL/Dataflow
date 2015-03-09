<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Builder;

use Xidea\Component\Dataflow\Factory\ProfileFactoryInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractProfileBuilder implements ProfileBuilderInterface
{
    /**
     * Currently built profile.
     *
     * @var \Xidea\Component\Dataflow\Model\ProfileInterface
     */
    protected $profile;

    /**
     * Profile factory.
     *
     * @var ProfileFactoryInterface
     */
    protected $factory;

    /*
     * 
     */
    public function __construct(ProfileFactoryInterface $profileFactory)
    {
        $this->factory = $profileFactory;
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
    public function setContext($context)
    {
        $this->profile->setContext($context);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFile(array $file)
    {
        $this->profile->setFile($file);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfile()
    {
        return $this->profile;
    }

}
