namespace Caravane\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
    * @ORM\Id
    * @ORM\Column(type="integer")
    * @ORM\generatedValue(strategy="AUTO")
    */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $lastname;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $facebookID;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $twitterID;

     /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $googleID;


    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $twitter_username;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $facebook_username;

      /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    protected $avatar;




    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    public function serialize()
    {
        return serialize(array($this->facebookID, $this->twitterID,  parent::serialize()));
    }

    public function unserialize($data)
    {
        list($this->facebookID, $this->twitterID,  $parentData) = unserialize($data);
        parent::unserialize($parentData);
    }

    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set facebookID
     *
     * @param string $facebookID
     * @return \User
     */
    public function setFacebookID($facebookID)
    {
        $this->facebookID = $facebookID;
        $this->setUsername("fb_".$facebookID);
        return $this;
    }

    /**
     * Get facebookID
     *
     * @return string $facebookID
     */
    public function getFacebookID()
    {
        return $this->facebookID;
    }


    /**
     * @param Array
     */
    public function setFBData($data)
    {
        if (isset($data['id'])) {
            $this->setFacebookID($data['id']);
            $this->addRole('ROLE_USER');
        }
        if (isset($data['username'])) {
            $this->setFacebookUsername($data['username']);

            $this->setAvatar($avatar="https://graph.facebook.com/".$data['username']."/picture");
        }
        if (isset($data['first_name'])) {
            $this->setFirstname($data['first_name']);
        }
        if (isset($data['last_name'])) {
            $this->setLastname($data['last_name']);
        }
        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }
    }



    /**
     * Set firstname
     *
     * @param string $firstname
     * @return \User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * Get firstname
     *
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return \User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * Get lastname
     *
     * @return string $lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
         * Set twitterID
         *
         * @param string $twitterID
         */
        public function setTwitterID($twitterID)
        {
            $this->twitterID = $twitterID;
            $this->setUsername("tw_".$twitterID);
            $this->salt = '';
        }

        /**
         * Get twitterID
         *
         * @return string
         */
        public function getTwitterID()
        {
            return $this->twitterID;
        }

        /**
         * Set twitter_username
         *
         * @param string $twitterUsername
         */
        public function setTwitterUsername($twitterUsername)
        {
            $this->twitter_username = $twitterUsername;
        }

        /**
         * Get twitter_username
         *
         * @return string
         */
        public function getTwitterUsername()
        {
            return $this->twitter_username;
        }



        /**
         * Set facebook_username
         *
         * @param string $facebookUsername
         */
        public function setFacebookUsername($facebookUsername)
        {
            $this->facebook_username = $facebookUsername;
        }

        /**
         * Get facebook_username
         *
         * @return string
         */
        public function getFacebookUsername()
        {
            return $this->facebook_username;
        }



    /**
     * Set avatar
     *
     * @param string $facebookAvatar
     * @return \User
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }

    /**
     * Get avatar
     *
     * @return string $facebookAvatar
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set googleID
     *
     * @param string $googleID
     * @return \User
     */
    public function setGoogleID($googleID)
    {
        $this->googleID = $googleID;
        return $this;
    }

    /**
     * Get googleID
     *
     * @return string $googleID
     */
    public function getGoogleID()
    {
        return $this->googleID;
    }

    public function getName() {
        if(isset($this->firstname) || isset($this->lastname)) {
            $name=$this->firstname." ".$this->lastname;
        }
        else if(isset($this->twitter_username)) {
            $name=$this->twitter_username;
        }
        else {
            $name=$this->username;
        }
        return $name;
    }
}
