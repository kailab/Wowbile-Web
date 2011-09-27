<?php
namespace Wowbile\Bundle\BackendBundle\Controller;

use Kailab\Bundle\SharedBundle\HttpFoundation\FileResponse;

use Kailab\Bundle\SharedBundle\Controller\EntityCrudController;
use Wowbile\Bundle\BackendBundle\Form\DownloadType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DownloadController extends EntityCrudController
{
	// implement abstract methods
	
	protected function getFormType()
	{
		return new DownloadType();
	}
	
	protected function getViewPrefix()
	{
		return 'WowbileBackendBundle:Download';
	}
	
	protected function getRoutePrefix()
	{
		return 'backend_download_';
	}
	
	protected function getEntityName()
	{
		return 'WowbileEntityBundle:Download';
	}
	
	// overwrite actions to set templates
	
	/**
	* @Route("/download", name="backend_download_index")
	* @Template()
	*/
	public function indexAction()
	{
		return parent::indexAction();
	}
	
	/**
	* @Route("/download/new", name="backend_download_new")
	* @Template()
	*/
	public function newAction()
	{
		return parent::newAction();
	}
	
	/**
	* @Route("/download/edit/{id}", name="backend_download_edit")
	* @Template()
	*/
	public function editAction()
	{
		return parent::editAction();
	}
	
	/**
	* @Route("/download/delete/{id}", name="backend_download_delete")
	* @Template()
	*/
	public function deleteAction()
	{
		return parent::deleteAction();
	}
	
	/**
	* @Route("/download/toggle/{id}", name="backend_download_toggle")
	* @Template()
	*/
	public function toggleAction()
	{
		return parent::toggleAction();
	}
	
	/**
	* @Route("/download/up/{id}", name="backend_download_up")
	* @Template()
	*/
	public function upAction($id)
	{
		return parent::upAction($id);
	}
	
	/**
	 * @Route("/download/down/{id}", name="backend_download_down")
	 * @Template()
	 */
	public function downAction($id)
	{
		return parent::downAction($id);
	}
	
	/**
	* @Route("/download/file/{id}", name="backend_download_file")
	* @Template()
	*/
	public function fileAction($id)
	{
		$entity = $this->findEntity($id);
		return $entity->getFileResponse();
	}
	
}