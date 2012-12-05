<?php

namespace Caravane\LunchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caravane\LunchBundle\Entity\Lunch
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Caravane\LunchBundle\Entity\LunchRepository")
 */
class Lunch
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    private $description;

    /**
     * @var date $date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var decimal $price
     *
     * @ORM\Column(name="price", type="decimal",scale=2)
     */
    private $price;
	
	
	
	/**
	 * 
	 * @ORM\ManyToOne(targetEntity="Restaurant")
     * @ORM\JoinColumn(name="restaurant_id", referencedColumnName="id")
	 * 
	 */
	private $restaurant;
	
	
	 /**
     *  @ORM\ManyToOne(targetEntity="Category")
     *  @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
	

	
	
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param text $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return text 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set date
     *
     * @param date $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set price
     *
     * @param decimal $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return decimal 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set restaurant
     *
     * @param Caravane\LunchBundle\Entity\Restaurant $restaurant
     */
    public function setRestaurant(\Caravane\LunchBundle\Entity\Restaurant $restaurant)
    {
        $this->restaurant = $restaurant;
    }

    /**
     * Get restaurant
     *
     * @return Caravane\LunchBundle\Entity\Restaurant 
     */
    public function getRestaurant()
    {
        return $this->restaurant;
    }

    
	
	

    
    

    /**
     * Set category
     *
     * @param Caravane\LunchBundle\Entity\Category $category
     */
    public function setCategory(\Caravane\LunchBundle\Entity\Category $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Caravane\LunchBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}