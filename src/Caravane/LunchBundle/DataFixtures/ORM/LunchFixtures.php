<?php
// src/Blogger/BlogBundle/DataFixtures/ORM/CommentFixtures.php

namespace Caravane\LunchBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Caravane\LunchBundle\Entity\Lunch;
use Caravane\LunchBundle\Entity\Restaurant;

use Doctrine\Common\Persistence\ObjectManager;


class LunchFixtures extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{
	
	private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
	
	
	
    public function load(ObjectManager $manager)
    {

        $lunch = new Lunch();
		$lunch->setName("Un super plat du jour");
		
		$lunch->setPrice("12.00");
		$lunch->setCategory($manager->merge($this->getReference('category-3')));
		$lunch->setDate(new \DateTime());
        $lunch->setRestaurant($manager->merge($this->getReference('restaurant-1')));
        $manager->persist($lunch);
		
		
		$lunch = new Lunch();
		$lunch->setName("Filet de rougets et riz sauvage");
		
		$lunch->setPrice("18.50");
		$lunch->setCategory($manager->merge($this->getReference('category-1')));
		$lunch->setDate(new \DateTime());
        $lunch->setRestaurant($manager->merge($this->getReference('restaurant-2')));
        $manager->persist($lunch);
		
		$lunch = new Lunch();
		$lunch->setName("Poulet basquaise");
		
		$lunch->setPrice("12.00");
		$lunch->setCategory($manager->merge($this->getReference('category-2')));
		$lunch->setDate(new \DateTime());
        $lunch->setRestaurant($manager->merge($this->getReference('restaurant-3')));
        $manager->persist($lunch);
		

		$lunch = new Lunch();
		$lunch->setName("Confit de canard à la landaise");
		
		$lunch->setPrice("17.00");
		$lunch->setCategory($manager->merge($this->getReference('category-2')));
		$lunch->setDate(new \DateTime());
		$lunch->setRestaurant($manager->merge($this->getReference('restaurant-4')));
        $manager->persist($lunch);
		
		$lunch = new Lunch();
		$lunch->setName("Chili con carne");
		
		$lunch->setPrice("8.90");
		$lunch->setCategory($manager->merge($this->getReference('category-2')));
		$lunch->setDate(new \DateTime());
        $lunch->setRestaurant($manager->merge($this->getReference('restaurant-5')));
        $manager->persist($lunch);
		
		$lunch = new Lunch();
		$lunch->setName("Poulet grillé");
		
		$lunch->setPrice("12.9");
		$lunch->setCategory($manager->merge($this->getReference('category-2')));
		$lunch->setDate(new \DateTime());
        $lunch->setRestaurant($manager->merge($this->getReference('restaurant-6')));
        $manager->persist($lunch);
	
		
		
		


        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}