<?php

namespace Caravane\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\RedirectResponse;

class DefaultController extends Controller
{
    /**
        * @Route("/", name="carvane_login_page")
        *
        */
        public function loginAction()
        {


          return $this->render('CaravaneNooneatBundle:Default:login.html.twig',array());


        }

        /**
        * @Route("/twitter", name="login_twitter")
        *
        */
        public function connectTwitterAction()
        {

          $request = $this->get('request');
          $twitter = $this->get('fos_twitter.service');

          $authURL = $twitter->getLoginUrl($request);
          $response = new RedirectResponse($authURL);

          return $response;

        }

}
