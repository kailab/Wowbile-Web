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
	
	public function getAnalytics($host=null)
	{
		$keys = $this->config['analytics'];
		$key = null;
		if(is_string($keys)){
			$key = $keys;
		}else if(is_array($keys)){
			foreach($keys as $domain=>$k){
				if(strrpos($host,$domain) == strlen($host)-strlen($domain)){
					$key = $k;
					break;
				}
			}
		}
		if($key){
			return json_encode($key);
		}
	}
}