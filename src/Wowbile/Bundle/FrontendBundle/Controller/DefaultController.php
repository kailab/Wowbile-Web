<?php

namespace Wowbile\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
	protected function getHomepageTestimony()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repo = $em->getRepository('WowbileEntityBundle:Testimony');
		return $repo->findFeatured();
	}
	
	protected function getHomepageDownload()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repo = $em->getRepository('WowbileEntityBundle:Download');
		return $repo->findForHomepage();
	}
	
	protected function getHomepageWowkipedia()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repo = $em->getRepository('WowbileEntityBundle:WowkipediaEntry');
		$entries = $repo->findForHomepage();
		return $repo->groupByLetters($entries);
	}
	
	protected function getHomepageLinks()
	{
		$em = $this->getDoctrine()->getEntityManager();
		$repo = $em->getRepository('WowbileEntityBundle:Link');
		$links = $repo->findForHomepage();
	}
	
    /**
     * @Route("/", name="frontend_homepage")
     * @Template()
     */
    public function indexAction()
    {
		return array(
			'testimony'		=> $this->getHomepageTestimony(),
			'download'		=> $this->getHomepageDownload(),
			'wowkipedia'	=> $this->getHomepageWowkipedia(),
			'links'			=> $this->getHomepageLinks(),
		);
    }

    /**
    * @Route("/who", name="frontend_who")
    * @Template()
    */
    public function whoAction()
    {
    	return array();
    }
    
    /**
    * @Route("/contact", name="frontend_contact")
    * @Template()
    */
    public function contactAction()
    {
    	return array();
    }
    
}
