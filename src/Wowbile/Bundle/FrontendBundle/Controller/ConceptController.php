<?php

namespace Wowbile\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ConceptController extends Controller
{
	protected function getRepository()
	{
		$em = $this->getDoctrine()->getEntityManager();
		return $em->getRepository('WowbileEntityBundle:Concept');
	}
	
    /**
     * @Route("/concepts", name="frontend_concepts")
     * @Template()
     */
    public function indexAction()
    {
    	$repo = $this->getRepository();
		return array(
			'concepts' => $repo->findAllActive()
		);
    }
    
    /**
    * @Route("/concepts/{slug}", name="frontend_concept")
    * @Template()
    */
    public function showAction($slug)
    {
    	$repo = $this->getRepository();
    	$concept = $repo->findActiveBySlug($slug);
    	if(!$concept){
    		throw new NotFoundHttpException('The concept does not exist.');
    	}
    	return array(
    		'concept' => $concept
    	);
    }

}
