<?php

namespace Caravane\LunchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Ivory\GoogleMapBundle\Model\MapTypeId;

use Caravane\LunchBundle\Entity\Lunch;
use Caravane\LunchBundle\Form\LunchType;

/**
 * Lunch controller.
 *
 * @Route("")
 */
class LunchController extends Controller
{
    /**
     * 
     *
     * @Route("/lunch", name="lunch")
     * @Template()
     */
    public function indexAction()
    {
        
		$map = $this->getMap();
		

        return array('map'=>$map);
    }
	
	/**
     * Lists all Lunch entities.
     *
     * @Route("/list/{lat}/{lng}/{zoom}", name="lunch_list", options={"expose"=true})
	 * @Method("GET")
     * @Template()
     */
	public function getLunchesAction($lat,$lng,$zoom) {
		
		$request = $this->getRequest();
		
		$boundaries=explode(',',$request->query->get('boundaries'));
		$sortBy=$request->query->get('sortBy');
		$em = $this->getDoctrine()->getEntityManager();
        $entities = $em->getRepository('CaravaneLunchBundle:Lunch')->getAll($lat,$lng,$zoom,$boundaries,$sortBy);
		return array('entities' => $entities);
	}


    /**
     * Lists all User entities.
     *
     * @Route("/user/lunch", name="user_lunch")
     * @Template()
     */
    public function userIndexAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CaravaneLunchBundle:Lunch')->findByUser($user);

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Lunch entity.
     *
     * @Route("/user/lunch/{id}/show", name="user_lunch_show")
     * @Template()
     */
    public function userShowAction($id)
    {
    	
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CaravaneLunchBundle:Lunch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lunch entity.');
        }

        $deleteForm = $this->userCreateDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Lunch entity.
     *
     * @Route("/user/lunch/new", name="user_lunch_new")
     * @Template()
     */
    public function userNewAction()
    {
         $user = $this->container->get('security.context')->getToken()->getUser();
        $entity = new Lunch();
        $form   = $this->createForm(new LunchType(), $entity,array('user'=>$user));

        return array(
            'entity' => $entity,
            'form'   => $form->createView()

        );
    }

    /**
     * Creates a new Lunch entity.
     *
     * @Route("/user/lunch/create", name="user_lunch_create")
     * @Method("post")
     * @Template("CaravaneLunchBundle:Lunch:userNew.html.twig")
     */
    public function userCreateAction()
    {
        $user = $this->container->get('security.context')->getToken()->getUser();

        $entity  = new Lunch();
        $request = $this->getRequest();
        $form    = $this->createForm(new LunchType(), $entity,array('user'=>$user));
        $form->bindRequest($request);

        if ($form->isValid()) {
        	
			
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_lunch_show', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Lunch entity.
     *
     * @Route("/user/lunch/{id}/edit", name="user_lunch_edit")
     * @Template()
     */
    public function userEditAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CaravaneLunchBundle:Lunch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lunch entity.');
        }

        $editForm = $this->createForm(new LunchType(), $entity);
        $deleteForm = $this->userCreateDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Lunch entity.
     *
     * @Route("/user/lunch/{id}/update", name="user_lunch_update")
     * @Method("post")
     * @Template("CaravaneLunchBundle:Lunch:userEdit.html.twig")
     */
    public function userUpdateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CaravaneLunchBundle:Lunch')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Lunch entity.');
        }

        $editForm   = $this->createForm(new LunchType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lunch_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Lunch entity.
     *
     * @Route("/user/lunch/{id}/delete", name="user_lunch_delete")
     * @Method("post")
     */
    public function userDeleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CaravaneLunchBundle:Lunch')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Lunch entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user_lunch'));
    }

    private function userCreateDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
	
	
	
	
	
	
	
	
	
	
	private function getMap() {
		// Requests the ivory google map service
		$map = $this->get('ivory_google_map.map');
		
		// Configure your map options
		$map->setPrefixJavascriptVariable('map_');
		$map->setHtmlContainerId('map_main_canvas');
		
		$map->setAsync(false);
		
		$map->setAutoZoom(false);
		
		$map->setCenter(0, 0, true);
		$map->setMapOption('zoom', 16);
		
		$map->setBound(-2.1, -3.9, 2.6, 1.4, true, true);
		
		$map->setMapOption('mapTypeId', MapTypeId::ROADMAP);
		$map->setMapOption('mapTypeId', 'roadmap');
		
		$map->setMapOption('disableDefaultUI', true);
		$map->setMapOption('disableDoubleClickZoom', true);
		$map->setMapOptions(array(
		    'disableDefaultUI' => true,
		    'disableDoubleClickZoom' => true
		));
		
		$map->setStylesheetOption('width', '600px');
		$map->setStylesheetOption('height', '300px');
		$map->setStylesheetOptions(array(
		    'width' => '600px',
		    'height' => '300px'
		));
		
		$map->setLanguage('en');
		$map->getEventManager()->addDomEventOnce($this->setGeoLocation($map));
		
		return $map;
	}
	
	
	private function setGeoLocation($map) {
		$instance = $map->getJavascriptVariable();
		$eventName="tilesloaded";
		$handle = 'function(){lunchMap.setClientPosition('.$instance.');}';
		$event = $this->get('ivory_google_map.event');
		$event->setInstance($instance);
		$event->setEventName($eventName);
		$event->setHandle($handle);
		return $event;
	}

	
}
