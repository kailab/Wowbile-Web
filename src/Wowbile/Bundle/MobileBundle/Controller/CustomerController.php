<?php

namespace Wowbile\Bundle\MobileBundle\Controller;

use Wowbile\Bundle\FrontendBundle\Controller\CustomerController as Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CustomerController extends Controller
{
	/**
     * @Route("/customers", name="mobile_customers")
     * @Template()
     */
    public function indexAction()
    {
		return parent::indexAction();
    }
    
    /**
    * @Route("/customer/{slug}", name="mobile_customer")
    * @Template()
    */
    public function showAction($slug)
    {
    	return parent::showAction($slug);
    }
}
