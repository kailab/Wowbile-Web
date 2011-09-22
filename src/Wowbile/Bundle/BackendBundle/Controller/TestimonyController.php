<?php
namespace Wowbile\Bundle\BackendBundle\Controller;

use Kailab\Bundle\SharedBundle\Controller\EntityCrudController;
use Wowbile\Bundle\BackendBundle\Form\TestimonyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TestimonyController extends EntityCrudController
{
	// implement abstract methods
	
	protected function getFormType()
	{
		return new TestimonyType();
	}
	
	protected function getViewPrefix()
	{
		return 'WowbileBackendBundle:Testimony';
	}
	
	protected function getRoutePrefix()
	{
		return 'backend_testimony_';
	}
	
	protected function getEntityName()
	{
		return 'WowbileEntityBundle:Testimony';
	}
	
	// overwrite actions to set templates
	
	/**
	* @Route("/testimony", name="backend_testimony_index")
	* @Template()
	*/
	public function indexAction()
	{
		return parent::indexAction();
	}
	
	/**
	* @Route("/testimony/new", name="backend_testimony_new")
	* @Template()
	*/
	public function newAction()
	{
		return parent::newAction();
	}
	
	/**
	* @Route("/testimony/edit/{id}", name="backend_testimony_edit")
	* @Template()
	*/
	public function editAction()
	{
		return parent::editAction();
	}
	
	/**
	* @Route("/testimony/delete/{id}", name="backend_testimony_delete")
	* @Template()
	*/
	public function deleteAction()
	{
		return parent::deleteAction();
	}
	
	/**
	* @Route("/testimony/toggle/{id}", name="backend_testimony_toggle")
	* @Template()
	*/
	public function toggleAction()
	{
		return parent::toggleAction();
	}
	
}