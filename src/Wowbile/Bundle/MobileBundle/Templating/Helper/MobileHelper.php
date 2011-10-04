<?php

namespace Wowbile\Bundle\MobileBundle\Templating\Helper;

use Wowbile\Bundle\FrontendBundle\Templating\Helper\FrontendHelper;

class MobileHelper extends FrontendHelper
{
	public function getName()
	{
		return 'mobile';
	}
	
	public function getMainMenuItems($code = null)
	{
		$items = parent::getMainMenuItems($code);
		if($code != 'es' && $code !== null){
			unset($items['mobile_concepts']);
			unset($items['mobile_customers']);
		}
		return $items;
	}
}