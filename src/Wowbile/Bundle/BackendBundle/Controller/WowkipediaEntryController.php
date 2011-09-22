<?php
namespace Wowbile\Bundle\BackendBundle\Controller;

use Kailab\Bundle\SharedBundle\Controller\EntityCrudController;
use Wowbile\Bundle\BackendBundle\Form\WowkipediaEntryType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WowkipediaEntryController extends EntityCrudController
{
	// implement abstract methods
	
	protected function getFormType()
	{
		return new WowkipediaEntryType();
	}
	
	protected function getViewPrefix()
	{
		return 'WowbileBackendBundle:WowkipediaEntry';
	}
	
	protected function getRoutePrefix()
	{
		return 'backend_wowkipedia_entry_';
	}
	
	protected function getEntityName()
	{
		return 'WowbileEntityBundle:WowkipediaEntry';
	}
	
	// overwrite actions to set templates
	
	/**
	* @Route("/wowkipedia", name="backend_wowkipedia_entry_index")
	* @Template()
	*/
	public function indexAction()
	{
		return parent::indexAction();
	}
	
	/**
	* @Route("/wowkipedia/new", name="backend_wowkipedia_entry_new")
	* @Template()
	*/
	public function newAction()
	{
		return parent::newAction();
	}
	
	/**
	* @Route("/wowkipedia/edit/{id}", name="backend_wowkipedia_entry_edit")
	* @Template()
	*/
	public function editAction()
	{
		return parent::editAction();
	}
	
	/**
	* @Route("/wowkipedia/delete/{id}", name="backend_wowkipedia_entry_delete")
	* @Template()
	*/
	public function deleteAction()
	{
		return parent::deleteAction();
	}
	
	/**
	* @Route("/wowkipedia/toggle/{id}", name="backend_wowkipedia_entry_toggle")
	* @Template()
	*/
	public function toggleAction()
	{
		return parent::toggleAction();
	}
	
	/**
	* @Route("/wowkipedia/homepage/{id}", name="backend_wowkipedia_entry_homepage")
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
			$msg = 'Entry set to homepage correctly.';
		}else {
			$msg = 'Entry removed from homepage correctly.';
		}
		$session = $this->get('session');
		$session->setFlash('notice',$msg, true);
	
		return $this->redirectCrud('index');
	}
	
}