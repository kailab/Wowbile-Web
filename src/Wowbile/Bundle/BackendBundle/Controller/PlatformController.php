<?php

namespace Wowbile\Bundle\BackendBundle\Controller;

use Wowbile\Bundle\BackendBundle\Form\PlatformType;
use Wowbile\Bundle\EntityBundle\Entity\Platform;

use Kailab\Bundle\SharedBundle\Controller\EntityCrudController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PlatformController extends EntityCrudController
{
    protected function getEntityName()
    {
    	return 'WowbileEntityBundle:Platform';
    }
    
    protected function getViewPrefix()
    {
    	return 'WowbileBackendBundle:Platform';
    }
    
    protected function getRoutePrefix()
    {
    	return 'backend_platform_';
    }

    protected function getFormType()
    {
        return new PlatformType();
    }
    
    // overwrite actions to set templates
    
    /**
     * @Route("/platform", name="backend_platform_index")
     * @Template()
     */
    public function indexAction()
    {
    	return parent::indexAction();
    }
    
    /**
     * @Route("/platform/new", name="backend_platform_new")
     * @Template()
     */
    public function newAction()
    {
    	return parent::newAction();
    }
    
    /**
     * @Route("/platform/edit/{id}", name="backend_platform_edit")
     * @Template()
     */
    public function editAction($id)
    {
    	return parent::editAction($id);
    }
    
    /**
     * @Route("/platform/delete/{id}", name="backend_platform_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
    	return parent::deleteAction($id);
    }
    
    /**
     * @Route("/platform/toggle/{id}", name="backend_platform_toggle")
     * @Template()
     */
    public function toggleAction($id)
    {
    	return parent::toggleAction($id);
    }
}
