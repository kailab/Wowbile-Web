<?php

namespace Wowbile\Bundle\MobileBundle\Controller;

use Wowbile\Bundle\FrontendBundle\Controller\ConceptController as Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ConceptController extends Controller
{
	/**
     * @Route("/concepts", name="mobile_concepts")
     * @Template()
     */
    public function indexAction()
    {
		return parent::indexAction();
    }
    
    /**
    * @Route("/concepts/{slug}", name="mobile_concept")
    * @Template()
    */
    public function showAction($slug)
    {
    	return parent::showAction($slug);
    }
}
