<?php

namespace Wowbile\Bundle\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DownloadController extends Controller
{
	protected function getRepository()
	{
		$em = $this->getDoctrine()->getEntityManager();
		return $em->getRepository('WowbileEntityBundle:Download');
	}
	
   /**
    * @Route("/download/file/{id}", name="frontend_download_file")
    * @Template()
    */
    public function fileAction($id)
    {
    	$repo = $this->getRepository();
    	$download = $repo->findActiveById($id);
    	if(!$download){
    		throw new NotFoundHttpException('The download does not exist.');
    	}
    	
    	return $download->getFileResponse();
    }
    
}
