<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/CommentFixtures.php

namespace Caravane\LunchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Caravane\LunchBundle\Entity\Category;

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

        $category1 = new Category();
		$category1->setName("Fish");
		$category1->setSlug("fish");
		$manager->persist($category1);
		
		$category2 = new Category();
		$category2->setName("Meat");
		$category2->setSlug("meat");
		$manager->persist($category2);

		$category3 = new Category();
		$category3->setName("Vegetarian");
		$category3->setSlug("vegetarian");
		$manager->persist($category3);
		
		
		


        $manager->flush();

        $this->addReference('category-1', $category1);
        $this->addReference('category-2', $category2);
        $this->addReference('category-3', $category3);
    }

    public function getOrder()
    {
        return 0;
    }
}