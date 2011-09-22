<?php

namespace Wowbile\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="frontend_homepage")
     * @Template()
     */
    public function indexAction()
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	$repo = $em->getRepository('WowbileEntityBundle:Testimony');
    	$testimony = $repo->findFeatured();
    	$repo = $em->getRepository('WowbileEntityBundle:WowkipediaEntry');
    	$wowkipedia = $repo->findForHomepage();
    	$wowkipedia = $repo->groupByLetters($wowkipedia);
    	$repo = $em->getRepository('WowbileEntityBundle:Link');
    	$links = $repo->findForHomepage();
		return array(
			'testimony'		=> $testimony,
			'wowkipedia'	=> $wowkipedia,
			'links'			=> $links,
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
