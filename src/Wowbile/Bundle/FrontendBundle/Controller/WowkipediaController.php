<?php

namespace Wowbile\Bundle\FrontendBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class WowkipediaController extends Controller
{
	protected function getRepository()
	{
		$em = $this->getDoctrine()->getEntityManager();
		return $em->getRepository('WowbileEntityBundle:WowkipediaEntry');
	}
	
	/**
     * @Route("/wowkipedia", name="wowkipedia")
     * @Template()
     */
    public function indexAction()
    {
		$repo = $this->getRepository();
    	$entries = $repo->findAllActive();
    	$entries = $repo->groupByLetters($entries,2);    	
    	
    	$letters = range('a','z');
		return array(
			'entries'	=> $entries,
			'letters' 	=> $letters
		);
    }
    
    /**
    * @Route("/wowkipedia/{name}", name="wowkipedia_entry")
    * @Template()
    */
    public function showAction($name)
    {
    	$repo = $this->getRepository();
    	$entry = $repo->findActiveByName($name);
    	if(!$entry){
    		throw new NotFoundHttpException('The wikipedia entry does not exist.');
    	}
    	return array(
   			'entry'	=> $entry,
    	);
    }

}
