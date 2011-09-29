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
		return array(
			'testimony'		=> $this->getHomepageTestimony(),
			'download'		=> $this->getHomepageDownload()
		);
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
    
    /**
    * @Route("/links", name="mobile_links")
    * @Template()
    */
    public function linksAction()
    {
    	return array(
    		'links'	=> $this->getHomepageLinks(),
    	);
    }
    
}
