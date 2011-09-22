<?php
namespace Wowbile\Bundle\BackendBundle\Controller;

use Kailab\Bundle\SharedBundle\Controller\EntityCrudController;
use Wowbile\Bundle\BackendBundle\Form\ConceptType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ConceptController extends EntityCrudController
{
	// implement abstract methods
	
	protected function getFormType()
	{
		return new ConceptType();
	}
	
	protected function getViewPrefix()
	{
		return 'WowbileBackendBundle:Concept';
	}
	
	protected function getRoutePrefix()
	{
		return 'backend_concept_';
	}
	
	protected function getEntityName()
	{
		return 'WowbileEntityBundle:Concept';
	}
	
	// overwrite actions to set templates
	
	/**
	* @Route("/concept", name="backend_concept_index")
	* @Template()
	*/
	public function indexAction()
	{
		return parent::indexAction();
	}
	
	/**
	* @Route("/concept/new", name="backend_concept_new")
	* @Template()
	*/
	public function newAction()
	{
		return parent::newAction();
	}
	
	/**
	* @Route("/concept/edit/{id}", name="backend_concept_edit")
	* @Template()
	*/
	public function editAction()
	{
		return parent::editAction();
	}
	
	/**
	* @Route("/concept/delete/{id}", name="backend_concept_delete")
	* @Template()
	*/
	public function deleteAction()
	{
		return parent::deleteAction();
	}
	
	/**
	* @Route("/concept/toggle/{id}", name="backend_concept_toggle")
	* @Template()
	*/
	public function toggleAction()
	{
		return parent::toggleAction();
	}
	
	/**
	* @Route("/concept/up/{id}", name="backend_concept_up")
	* @Template()
	*/
	public function upAction($id)
	{
		return parent::upAction($id);
	}
	
	/**
	 * @Route("/concept/down/{id}", name="backend_concept_down")
	 * @Template()
	 */
	public function downAction($id)
	{
		return parent::downAction($id);;
	}
	
	protected function saveEntity($entity)
	{
		$repo = $this->getRepository();
		// remove old screenshots
		$repo->deleteScreenshots($entity);
		
		return parent::saveEntity($entity);
	}
	
}