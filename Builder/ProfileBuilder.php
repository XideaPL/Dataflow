<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Component\Dataflow\Builder;

use Xidea\Component\Base\Factory\ModelFactoryInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ProfileBuilder implements ProfileBuilderInterface
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
     * @var ModelFactoryInterface
     */
    protected $factory;

    /*
     * 
     */
    public function __construct(ModelFactoryInterface $profileFactory)
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
    public function setFields(array $fields)
    {
        $this->profile->setFields($fields);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setReader(array $reader)
    {
        $this->profile->setReader($reader);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setWriter(array $writer)
    {
        $this->profile->setWriter($writer);
    }

    /**
     * {@inheritdoc}
     */
    public function getProfile()
    {
        return $this->profile;
    }

}
