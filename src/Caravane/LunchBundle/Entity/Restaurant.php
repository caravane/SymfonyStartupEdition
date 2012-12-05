<?php

namespace Caravane\LunchBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;

use Caravane\UserBundle\Entity\User;

/**
 * Caravane\LunchBundle\Entity\Restaurant
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Caravane\LunchBundle\Entity\RestaurantRepository")
 */
class Restaurant
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
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(length=128, unique=true)
     */
	private $slug;

    /**
     * @var text $description
     *
     * @ORM\Column(name="description", type="text",nullable=true)
     */
    private $description;

    /**
     * @var string $country
     *
     * @ORM\Column(name="country", type="string", length=128)
     */
    private $country;

    /**
     * @var string $city
     *
     * @ORM\Column(name="city", type="string", length=128)
     */
    private $city;

    /**
     * @var string $address1
     *
     * @ORM\Column(name="address1", type="string", length=255)
     */
    private $address1;

    /**
     * @var string $address2
     *
     * @ORM\Column(name="address2", type="string", length=255,nullable=true)
     */
    private $address2;

    /**
     * @var string $zip
     *
     * @ORM\Column(name="zip", type="string", length=16)
     */
    private $zip;
	
	/**
     * @var string $state
     *
     * @ORM\Column(name="state", type="string", length=255,nullable=true)
     */
    private $state;
	
	/**
     * @var string $phone
     *
     * @ORM\Column(name="phone", type="string", length=16,nullable=true)
     */
    private $phone;
	
	/**
     * @var string $fax
     *
     * @ORM\Column(name="fax", type="string", length=16,nullable=true)
     */
    private $fax;
	
	
	/**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=255,nullable=true)
     */
    private $email;
	
	/**
     * @var string $url
     *
     * @ORM\Column(name="url", type="string", length=255,nullable=true)
     */
    private $url;
    /**
     * @var integer $status
     *
     * @ORM\Column(name="status", type="boolean")
     */
     
     
     
     /**
     * @var integer $googleReference
     *
     * @ORM\Column(name="googleReference", type="string",length=255, nullable=true)
     */
    private $googleReference;
	
	
	
	 
     /**
     * @var integer $facebookReference
     *
     * @ORM\Column(name="facebookReference", type="string",length=255, nullable=true)
     */
    private $facebookReference;
	
	
    private $status;
	
	/**
     * @var string $lat
     *
     * @ORM\Column(name="lat", type="string",length=20,nullable=true)
     */
	private $lat;
	
	/**
     * @var string $lng
     *
     * @ORM\Column(name="lng", type="string",length=20,nullable=true)
     */
	private $lng;
	
	
	/**
     * @var string $currency
     *
     * @ORM\Column(name="currency", type="string",length=5,nullable=true)
     */
	private $currency;
	
	
	/**
     * @var integer $created
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;
	
	/**
     * @var integer $updated
     *
     * @ORM\Column(name="updated", type="datetime")
     */
    private $updated;
	
	
	/**
	 * 
	 * @ORM\ManyToOne(targetEntity="Caravane\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 * 
	 */
	private $user;
	
	
	
	private $distance;
	

    public function __toString() {
        return $this->name;
    }
	
	
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
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string 
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set address1
     *
     * @param string $address1
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;
    }

    /**
     * Get address1
     *
     * @return string 
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;
    }

    /**
     * Get address2
     *
     * @return string 
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set zip
     *
     * @param string $zip
     */
    public function setZip($zip)
    {
        $this->zip = $zip;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }
	
	
	public function getSlug()
    {
        return $this->slug;
    }
	
	
    /**
     * Set status
     *
     * @param integer $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Set lat
     *
     * @param float $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * Get lat
     *
     * @return float 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param float $lng
     */
    public function setLng($lng)
    {
        $this->lng = $lng;
    }

    /**
     * Get lng
     *
     * @return float 
     */
    public function getLng()
    {
        return $this->lng;
    }

    

  

    /**
     * Set user
     *
     * @param Caravane\UserBundle\Entity\User $user
     */
    public function setUser(\Caravane\UserBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return Caravane\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set state
     *
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set phone
     *
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set fax
     *
     * @param string $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set url
     *
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set googleReference
     *
     * @param string $googleReference
     */
    public function setGoogleReference($googleReference)
    {
        $this->googleReference = $googleReference;
    }

    /**
     * Get googleReference
     *
     * @return string 
     */
    public function getGoogleReference()
    {
        return $this->googleReference;
    }

    /**
     * Set facebookReference
     *
     * @param string $facebookReference
     */
    public function setFacebookReference($facebookReference)
    {
        $this->facebookReference = $facebookReference;
    }

    /**
     * Get facebookReference
     *
     * @return string 
     */
    public function getFacebookReference()
    {
        return $this->facebookReference;
    }

    /**
     * Set created
     *
     * @param date $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

    /**
     * Get created
     *
     * @return date 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param datetime $updated
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;
    }

    /**
     * Get updated
     *
     * @return datetime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set currency
     *
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * Get currency
     *
     * @return string 
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}