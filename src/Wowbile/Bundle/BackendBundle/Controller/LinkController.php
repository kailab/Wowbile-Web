<?php
namespace Wowbile\Bundle\BackendBundle\Controller;

use Kailab\Bundle\SharedBundle\Controller\EntityCrudController;
use Wowbile\Bundle\BackendBundle\Form\LinkType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class LinkController extends EntityCrudController
{
	// implement abstract methods
	
	protected function getFormType()
	{
		return new LinkType();
	}
	
	protected function getViewPrefix()
	{
		return 'WowbileBackendBundle:Link';
	}
	
	protected function getRoutePrefix()
	{
		return 'backend_link_';
	}
	
	protected function getEntityName()
	{
		return 'WowbileEntityBundle:Link';
	}
	
	// overwrite actions to set templates
	
	/**
	* @Route("/link", name="backend_link_index")
	* @Template()
	*/
	public function indexAction()
	{
		return parent::indexAction();
	}
	
	/**
	* @Route("/link/new", name="backend_link_new")
	* @Template()
	*/
	public function newAction()
	{
		return parent::newAction();
	}
	
	/**
	* @Route("/link/edit/{id}", name="backend_link_edit")
	* @Template()
	*/
	public function editAction()
	{
		return parent::editAction();
	}
	
	/**
	* @Route("/link/delete/{id}", name="backend_link_delete")
	* @Template()
	*/
	public function deleteAction()
	{
		return parent::deleteAction();
	}
	
	/**
	* @Route("/link/toggle/{id}", name="backend_link_toggle")
	* @Template()
	*/
	public function toggleAction()
	{
		return parent::toggleAction();
	}
	
	/**
	* @Route("/link/homepage/{id}", name="backend_link_homepage")
	* @Template()
	*/
	public function homepageAction()
	{
		$entity = $this->findById();
		$entity->setHomepage($entity->getHomepage() ? false : true);
	
		$em = $this->getEntityManager();
		$em->persist($entity);
		$em->flush();
	
		if($entity->getHomepage()){
			$msg = 'Link set to homepage correctly.';
		}else {
			$msg = 'Link removed from homepage correctly.';
		}
		$session = $this->get('session');
		$session->setFlash('notice',$msg, true);
	
		return $this->redirectCrud('index');
	}
	
}