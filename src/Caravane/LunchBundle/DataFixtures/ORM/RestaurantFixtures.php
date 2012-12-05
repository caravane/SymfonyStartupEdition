<?php

namespace Caravane\LunchBundle\DataFixtures\ORM;




use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Caravane\LunchBundle\Entity\Restaurant;
use Doctrine\Common\Persistence\ObjectManager;

use Ivory\GoogleMapBundle\Model\MapTypeId;

use Caravane\UserBundle\Entity\User;


class RestaurantFixtures extends AbstractFixture implements OrderedFixtureInterface , ContainerAwareInterface
{
	
	private $container;
	
	 public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
	
	public function load(ObjectManager $manager) {
		
		$owner1 = $this->container
			->get('doctrine')
			->getRepository('CaravaneUserBundle:User')
			->findOneByUsername('owner1');
			
		
		$owner2 = $this->container
			->get('doctrine')
			->getRepository('CaravaneUserBundle:User')
			->findOneByUsername('owner2');
			
		$owner3 = $this->container
			->get('doctrine')
			->getRepository('CaravaneUserBundle:User')
			->findOneByUsername('owner3');
			
			
		$restaurant1=new Restaurant;

		$restaurant1->setUser($owner1);
		$restaurant1->setName("La Canne en Ville");
		$restaurant1->setCurrency("EUR");
		$restaurant1->setAddress1("22 Rue de la Réforme");

	
		$restaurant1->setZip("1050");
		$restaurant1->setCity("Ixelles");
		$restaurant1->setState("");
		$restaurant1->setPhone("023472926");
		$restaurant1->setFax("023472926");
		$restaurant1->setEmail("info@lacanneenville.be");
		$restaurant1->setUrl("www.lacanneenville.be");
		$restaurant1->setCountry("Belgium");
		
		$latLng=$this->getLatLng($restaurant1);
		$restaurant1->setLat($latLng['lat']);
		$restaurant1->setLng($latLng['lng']);
		
		$restaurant1->setGoogleReference("");	
		$restaurant1->setFacebookReference("");	
		$restaurant1->setCreated(new \DateTime());

        $restaurant1->setUpdated($restaurant1->getCreated());
        $manager->persist($restaurant1);
		
		
		/*	Rue Lannoy 2  1050 Ixelles
02 644 19 49*/
		$restaurant2=new Restaurant;
		$restaurant2->setUser($owner2);
		$restaurant2->setName("Delecta");
		$restaurant2->setCurrency("EUR");
		$restaurant2->setAddress1("2 Rue Lannoy");


		$restaurant2->setZip("1050");
		$restaurant2->setCity("Ixelles");
		$restaurant2->setState("");
		$restaurant2->setPhone("026441949");
		$restaurant2->setFax("026441949");
		$restaurant2->setEmail("info@delecta.be");
		$restaurant2->setUrl("www.delecta.be");
		$restaurant2->setCountry("Belgium");	
		$latLng=$this->getLatLng($restaurant2);
		$restaurant2->setLat($latLng['lat']);
		$restaurant2->setLng($latLng['lng']);
		

		$restaurant2->setGoogleReference("");
		$restaurant2->setFacebookReference("");	
		$restaurant2->setCreated(new \DateTime());
        $restaurant2->setUpdated($restaurant2->getCreated());
        $manager->persist($restaurant2);
        

		/*
		 * Place Eugène Flagey 18  1050 Ixelles
02 640 35 08
		 * 
		 */
		$restaurant3=new Restaurant;
		$restaurant3->setUser($owner1);
		$restaurant3->setName("Café Belga");
		$restaurant3->setCurrency("USD");
		$restaurant3->setAddress1("18 Place Flagey");


		$restaurant3->setZip("1050");
		$restaurant3->setCity("Ixelles");
		$restaurant3->setState("");
		$restaurant3->setPhone("026403508");
		$restaurant3->setFax("026403508");
		$restaurant3->setEmail("info@cafebelga.be");
		$restaurant3->setUrl("www.cafebelga.be");
		$restaurant3->setCountry("Belgium");
		$latLng=$this->getLatLng($restaurant3);
		$restaurant3->setLat($latLng['lat']);
		$restaurant3->setLng($latLng['lng']);
		

		$restaurant3->setGoogleReference("");
		$restaurant3->setFacebookReference("");	
		$restaurant3->setCreated(new \DateTime());
        $restaurant3->setUpdated($restaurant3->getCreated());
        $manager->persist($restaurant3);
		

		/*
		 * 95, Rue de l’Aqueduc
1050 Ixelles (Bruxelles) 
Belgique
Téléphone	
02-537.87.87
		 */
		$restaurant4=new Restaurant;
		$restaurant4->setUser($owner1);
		$restaurant4->setName("Tan");
		$restaurant4->setCurrency("EUR");
		$restaurant4->setAddress1("95 Rue de l’Aqueduc");


		$restaurant4->setZip("1050");
		$restaurant4->setCity("Ixelles");
		$restaurant4->setState("");
		$restaurant4->setPhone("025378787");
		$restaurant4->setFax("025378788");
		$restaurant4->setEmail("info@tanclub.org");
		$restaurant4->setUrl("www.tanclub.org");
		$restaurant4->setCountry("Belgium");
		$latLng=$this->getLatLng($restaurant4);
		$restaurant4->setLat($latLng['lat']);
		$restaurant4->setLng($latLng['lng']);
		

		$restaurant4->setGoogleReference("");
		$restaurant4->setFacebookReference("");		
		$restaurant4->setCreated(new \DateTime());
        $restaurant4->setUpdated($restaurant4->getCreated());
        $manager->persist($restaurant4);
        

		/*
		 * 118A, Avenue Molière
1190 Forest (Bruxelles) 
Belgique
Téléphone	
02-345.72.32 * 
		 */
		$restaurant5=new Restaurant;
		
		$restaurant5->setUser($owner2);

		$restaurant5->setName("Oui-oui");
		$restaurant5->setCurrency("EUR");
		$restaurant5->setAddress1("118/A Avenue Molière");


		$restaurant5->setZip("1190");
		$restaurant5->setCity("Forest");
		$restaurant5->setState("");
		$restaurant5->setPhone("023457232");
		$restaurant5->setFax("");
		$restaurant5->setEmail("info@leouioui.be");
		$restaurant5->setUrl("www.leouioui.be");
		$restaurant5->setCountry("Belgium");
		$latLng=$this->getLatLng($restaurant5);
		$restaurant5->setLat($latLng['lat']);
		$restaurant5->setLng($latLng['lng']);
		

		$restaurant5->setGoogleReference("");	
		$restaurant5->setFacebookReference("");	

		$restaurant5->setCreated(new \DateTime());
      	$restaurant5->setUpdated($restaurant5->getCreated());

        $manager->persist($restaurant5);
		
		
		
		
		

		/*Variétés (Le)
plus d'infos »
Place Sainte-Croix 4, 1050 Ixelles, Belgique*/
		
		$restaurant6=new Restaurant;
		
		$restaurant6->setUser($owner3);

		$restaurant6->setName("Le Variétés");
		$restaurant6->setCurrency("USD");
		$restaurant6->setAddress1("4 Place Sainte-Croix");
		

		$restaurant6->setZip("1050");
		$restaurant6->setCity("Ixelles");
		$restaurant6->setState("");
		$restaurant6->setPhone("023457232");
		$restaurant6->setFax("");
		$restaurant6->setEmail("info@leouioui.be");
		$restaurant6->setUrl("www.levarietes.be");
		$restaurant6->setCountry("Belgium");
		$latLng=$this->getLatLng($restaurant6);
		$restaurant6->setLat($latLng['lat']);
		$restaurant6->setLng($latLng['lng']);
		

		$restaurant6->setGoogleReference("");	
		$restaurant6->setFacebookReference("");	

		$restaurant6->setCreated(new \DateTime());
      	$restaurant6->setUpdated($restaurant6->getCreated());
        $manager->persist($restaurant6);

		
		
		$manager->flush();
		
		

		$this->addReference('restaurant-1', $restaurant1);
        $this->addReference('restaurant-2', $restaurant2);
        $this->addReference('restaurant-3', $restaurant3);
        $this->addReference('restaurant-4', $restaurant4);
        $this->addReference('restaurant-5', $restaurant5);
		$this->addReference('restaurant-6', $restaurant6);
		
		
	}
	
	private function getLatLng($r) {
		$geocoder = $this->container->get('ivory_google_map.geocoder');
		$request = $this->container->get('ivory_google_map.geocoder_request')
    // Set address
    ->setAddress($r->getAddress1().",".$r->getCity().",".$r->getCountry())
    // Or set coordinate (reverse geocoding)
    ->setCoordinate(1.1, 2.1, true)
    ->setBound(-1.1, -2.1, 2.1, 1.1, true, true)
    ->setRegion('en')
    ->setLanguage('en')
    ->setSensor(false);
	$response = $geocoder->geocode($request);
	$result=$response->getResults();
	$lat=$result[0]->getGeometry()->getLocation()->getLatitude();
	$lng=$result[0]->getGeometry()->getLocation()->getLongitude();
	
		return array('lat'=>$lat,'lng'=>$lng);
	}

	public function getOrder()
    {
        return 1;
    }
	
}
