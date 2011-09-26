<?php

namespace Wowbile\Bundle\FrontendBundle\Controller;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class CustomerController extends Controller
{
	protected function getRepository()
	{
		$em = $this->getDoctrine()->getEntityManager();
		return $em->getRepository('WowbileEntityBundle:Customer');
	}
	
    /**
     * @Route("/customers", name="frontend_customers")
     * @Template()
     */
    public function indexAction()
    {
    	$repo = $this->getRepository();
		return array(
			'customers' => $repo->findAllActive()
		);
    }
    
    /**
    * @Route("/customer/{slug}", name="frontend_customer")
    * @Template()
    */
    public function showAction($slug)
    {
    	$repo = $this->getRepository();
    	$customer = $repo->findActiveBySlug($slug);
    	if(!$customer){
    		throw new NotFoundHttpException('The customer does not exist.');
    	}
    	return array(
    			'customer' => $customer
    	);
    }
	
}
