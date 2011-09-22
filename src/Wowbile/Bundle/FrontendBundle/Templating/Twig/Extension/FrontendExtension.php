<?php

namespace Wowbile\Bundle\FrontendBundle\Templating\Twig\Extension;

use Wowbile\Bundle\FrontendBundle\Templating\Helper\FrontendHelper;

use Kailab\Bundle\SharedBundle\Templating\Twig\Extension\HelperExtension;
use Symfony\Component\DependencyInjection\ContainerInterface;


class FrontendExtension extends HelperExtension
{
    public function getFilters()
    {
    	$filters = array();
       	$filters['wowbilify'] = new \Twig_Filter_Method($this,'wowbilify');
    	return $filters;
    }
    
    public function wowbilify($str)
    {
    	if($this->helper instanceof FrontendHelper){
    		return $this->helper->wowbilify($str);
    	}else{
    		return $str;
    	}
    }
}
