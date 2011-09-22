<?php

namespace Wowbile\Bundle\MobileBundle\Controller;

use Wowbile\Bundle\FrontendBundle\Controller\DefaultController as Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="mobile_homepage")
     * @Template()
     */
    public function indexAction()
    {
        return parent::indexAction();
    }
    
    /**
    * @Route("/who", name="mobile_who")
     * @Template()
    */
    public function whoAction()
    {
    	return parent::whoAction();
    }
    
    /**
    * @Route("/contact", name="mobile_contact")
     * @Template()
    */
    public function contactAction()
    {
    	return parent::contactAction();
    }
    
}
