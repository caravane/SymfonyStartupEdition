<?php

namespace Caravane\LunchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Caravane\LunchBundle\Entity\Restaurant;
use Caravane\LunchBundle\Form\RestaurantType;

/**
 * Restaurant controller.
 *
 * @Route("")
 */
class RestaurantController extends Controller
{
    /**
     * Lists all Restaurant entities.
     *
     * @Route("/user/restaurant", name="user_restaurant")
     * @Template()
     */
    public function userIndexAction()
    {
    	$user = $this->container->get('security.context')->getToken()->getUser();
		
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('CaravaneLunchBundle:Restaurant')->findBy(array('user'=>$user->getId()));

        return array('entities' => $entities);
    }

    /**
     * Finds and displays a Restaurant entity.
     *
     * @Route("user/restaurant/{id}/show", name="user_restaurant_show")
     * @Template()
     */
    public function userShowAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
		$user = $this->container->get('security.context')->getToken()->getUser();
        $entity = $em->getRepository('CaravaneLunchBundle:Restaurant')->findOneBy(array('user'=>$user->getId(),'id'=>$id));

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Restaurant entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        );
    }

    /**
     * Displays a form to create a new Restaurant entity.
     *
     * @Route("user/restaurant/new", name="user_restaurant_new")
     * @Template()
     */
    public function userNewAction()
    {
        $entity = new Restaurant();
        $form   = $this->createForm(new RestaurantType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Creates a new Restaurant entity.
     *
     * @Route("/user/restaurant/create", name="user_restaurant_create")
     * @Method("post")
     * @Template("CaravaneLunchBundle:Restaurant:new.html.twig")
     */
    public function userCreateAction()
    {
    	$user = $this->container->get('security.context')->getToken()->getUser();
		
        $entity  = new Restaurant();
        $request = $this->getRequest();
        $form    = $this->createForm(new RestaurantType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
			$entity->setUser($user);
			$entity->setCreated(new \DateTime());
			$entity->setUpdated($entity->getCreated());
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_restaurant', array('id' => $entity->getId())));
            
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView()
        );
    }

    /**
     * Displays a form to edit an existing Restaurant entity.
     *
     * @Route("/user/restaurant/{id}/edit", name="user_restaurant_edit")
     * @Template()
     */
    public function userEditAction($id)
    {
    	$user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CaravaneLunchBundle:Restaurant')->findOneBy(array("user"=>$user->GetId(),"id"=>$id));
		

        if (!$entity) {
            throw $this->userCreateNotFoundException('Unable to find Restaurant entity.');
        }

        $editForm = $this->createForm(new RestaurantType(), $entity);
        $deleteForm = $this->userCreateDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Restaurant entity.
     *
     * @Route("/user/restaurant/{id}/update", name="user_restaurant_update")
     * @Method("post")
     * @Template("CaravaneLunchBundle:Restaurant:edit.html.twig")
     */
    public function userUpdateAction($id)
    {
    	$user = $this->container->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('CaravaneLunchBundle:Restaurant')->findOneBy(array('user'=>$user->getId(),'id'=>$id));

        if (!$entity) {
            throw $this->userCreateNotFoundException('Unable to find Restaurant entity.');
        }

        $editForm   = $this->createForm(new RestaurantType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
        	
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('user_restaurant', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Restaurant entity.
     *
     * @Route("/user/restaurant/{id}/delete", name="user_restaurant_delete")
     * @Method("post")
     */
    public function userDeleteAction($id)
    {
    	$user = $this->container->get('security.context')->getToken()->getUser();
        $form = $this->userCreateDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('CaravaneLunchBundle:Restaurant')->findOneBy(array('user'=>$user->getId(),'id'=>$id));

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Restaurant entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('user_restaurant'));
    }

    private function userCreateDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }


}
