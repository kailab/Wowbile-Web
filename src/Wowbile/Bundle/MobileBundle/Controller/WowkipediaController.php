<?php

namespace Wowbile\Bundle\MobileBundle\Controller;

use Wowbile\Bundle\FrontendBundle\Controller\WowkipediaController as Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WowkipediaController extends Controller
{
    /**
     * @Route("/wowkipedia", name="mobile_wowkipedia")
     * @Template()
     */
    public function indexAction()
    {
    	$repo = $this->getDoctrine()->getEntityManager()->getRepository('WowbileEntityBundle:WowkipediaEntry');
    	$entries = $repo->findAllActive();
    	$entries = $repo->groupByLetters($entries);
    	
    	$letters = range('a','z');
		return array(
			'entries'	=> $entries,
			'letters' 	=> $letters
		);
    }
    
}
