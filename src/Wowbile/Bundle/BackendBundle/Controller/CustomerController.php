<?php
namespace Wowbile\Bundle\BackendBundle\Controller;

use Kailab\Bundle\SharedBundle\Controller\EntityCrudController;
use Wowbile\Bundle\BackendBundle\Form\CustomerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CustomerController extends EntityCrudController
{
	// implement abstract methods
	
	protected function getFormType()
	{
		return new CustomerType();
	}
	
	protected function getViewPrefix()
	{
		return 'WowbileBackendBundle:Customer';
	}
	
	protected function getRoutePrefix()
	{
		return 'backend_customer_';
	}
	
	protected function getEntityName()
	{
		return 'WowbileEntityBundle:Customer';
	}
	
	// overwrite actions to set templates
	
	/**
	* @Route("/customer", name="backend_customer_index")
	* @Template()
	*/
	public function indexAction()
	{
		return parent::indexAction();
	}
	
	/**
	* @Route("/customer/new", name="backend_customer_new")
	* @Template()
	*/
	public function newAction()
	{
		return parent::newAction();
	}
	
	/**
	* @Route("/customer/edit/{id}", name="backend_customer_edit")
	* @Template()
	*/
	public function editAction($id)
	{
		return parent::editAction($id);
	}
	
	/**
	* @Route("/customer/delete/{id}", name="backend_customer_delete")
	* @Template()
	*/
	public function deleteAction($id)
	{
		return parent::deleteAction($id);
	}
	
	/**
	* @Route("/customer/toggle/{id}", name="backend_customer_toggle")
	* @Template()
	*/
	public function toggleAction($id)
	{
		return parent::toggleAction($id);
	}
	
	/**
	* @Route("/customer/up/{id}", name="backend_customer_up")
	* @Template()
	*/
	public function upAction($id)
	{
		return parent::upAction($id);
	}
	
	/**
	 * @Route("/customer/down/{id}", name="backend_customer_down")
	 * @Template()
	 */
	public function downAction($id)
	{
		return parent::downAction($id);
	}
	
	protected function saveEntity($entity)
	{
		$repo = $this->getRepository();
		// remove old screenshots
		$repo->deleteScreenshots($entity);
		// fix links, setting translation
		$entity->fixLinks();
		// remove old links
		$repo->deleteLinks($entity);
		return parent::saveEntity($entity);
	}
	
}