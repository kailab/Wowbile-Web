<?php

namespace Wowbile\Bundle\BackendBundle\Controller;

use Kailab\Bundle\SharedBundle\Controller\EntityCrudController;
use Wowbile\Bundle\EntityBundle\Entity\Screenshot;
use Wowbile\Bundle\BackendBundle\Form\ScreenshotType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ScreenshotController extends EntityCrudController
{
	protected $limit = 8;
	
	protected function getEntityName()
    {
    	return 'WowbileEntityBundle:Screenshot';
    }
    
    protected function getViewPrefix()
    {
    	return 'WowbileBackendBundle:Screenshot';
    }
    
    public function getRoutePrefix()
    {
    	return 'backend_screenshot_';
    }

    protected function getFormType()
    {
        return new ScreenshotType();
    }
    
    // overwrite actions to set templates
    
    /**
     * @Route("/screenshot", name="backend_screenshot_index")
     * @Template()
     */
    public function indexAction()
    {
    	return parent::indexAction();
    }
    
    /**
     * @Route("/screenshot/new", name="backend_screenshot_new")
     * @Template()
     */
    public function newAction()
    {
    	return parent::newAction();
    }
    
    /**
     * @Route("/screenshot/edit/{id}", name="backend_screenshot_edit")
     * @Template()
     */
    public function editAction($id)
    {
    	return parent::editAction($id);
    }
    
    /**
     * @Route("/screenshot/delete/{id}", name="backend_screenshot_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
    	return parent::deleteAction($id);
    }
    
    /**
     * @Route("/screenshot/toggle/{id}", name="backend_screenshot_toggle")
     * @Template()
     */
    public function toggleAction($id)
    {
    	return parent::toggleAction($id);
    }
}
