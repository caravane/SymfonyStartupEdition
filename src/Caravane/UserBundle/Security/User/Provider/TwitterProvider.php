<?php
// src/Acme/YourBundle/Security/User/Provider/TwitterProvider.php


namespace Caravane\UserBundle\Security\User\Provider;

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session;
use \TwitterOAuth;
use FOS\UserBundle\Document\UserManager;
use Symfony\Component\Validator\Validator;

class TwitterProvider implements UserProviderInterface
{
    /**
     * @var \Twitter
     */
    protected $twitter_oauth;
    protected $userManager;
    protected $validator;
    protected $session;

    //public function __construct(TwitterOAuth $twitter_oauth, UserManager $userManager,Validator $validator, Session $session)
    public function __construct(TwitterOAuth $twitter_oauth, $userManager,$validator, $session)
    {
        $this->twitter_oauth = $twitter_oauth;
        $this->userManager = $userManager;
        $this->validator = $validator;
        $this->session = $session;
    }

    public function supportsClass($class)
    {
        return $this->userManager->supportsClass($class);
    }

    public function findUserByTwitterId($twitterID)
    {
        return $this->userManager->findUserBy(array('twitterID' => $twitterID));
    }

    public function findUserByTwitterUsername($username)
    {
        return $this->userManager->findUserBy(array('twitter_username' => $username));
    }

    public function loadUserByUsername($username)
    {

       // $user = $this->findUserByTwitterId($username);
        $user = $this->findUserByTwitterUsername($username);
//echo "return:---".$user->getId();

         $this->twitter_oauth->setOAuthToken( $this->session->get('access_token') , $this->session->get('access_token_secret'));

        try {
             $data = $this->twitter_oauth->get('account/verify_credentials');
/*
            echo "<pre>";
            print_r($data);
            echo "</pre>";
*/

        } catch (Exception $e) {
             $data = null;
        }

        if (!empty($data)) {
            if (empty($user)) {
                $user = $this->userManager->createUser();
                $user->setEnabled(true);
                $user->setPassword('');
                //$user->setAlgorithm('');
            }
           else {
            //echo "exists";
           }
            $username = $data->screen_name;


            $user->setTwitterID($data->id);
            $user->setEmail($data->id."@twitter.com");
            $user->setTwitterUsername($username);
            //$user->setEmail('');
            $user->setAvatar($data->profile_image_url);
            $user->setFirstname($data->name);

           // $this->userManager->updateUser($user);
        }

        if (empty($user)) {

            throw new UsernameNotFoundException('The user is not authenticated on twitter');
        }

        return $user;

    }

    public function refreshUser(UserInterface $user)
    {
        if (!$this->supportsClass(get_class($user)) || !$user->getTwitterID()) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', get_class($user)));
        }

        return $this->loadUserByUsername($user->getTwitterID());
    }
}
