<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/CommentFixtures.php

namespace Caravane\StartupEditionBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Caravane\UserBundle\Document\User;

use Doctrine\Common\Persistence\ObjectManager;


class CategoryFixtures extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{
	
	private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
	
	
	
    public function load(ObjectManager $manager)
    {
    	
    }

    public function getOrder()
    {
        return 0;
    }
}