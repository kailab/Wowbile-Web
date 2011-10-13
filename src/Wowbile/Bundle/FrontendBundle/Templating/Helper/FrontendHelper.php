<?php

namespace Wowbile\Bundle\FrontendBundle\Templating\Helper;

use Symfony\Component\Templating\Helper\Helper;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class FrontendHelper extends Helper
{
    protected $config = null;
    
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function getName()
    {
        return 'frontend';
    }

    public function getConfiguration()
    {
        return $this->config;
    }

    public function getFacebookUrl()
    {
        if(isset($this->config['facebook'])){
            return "http://www.facebook.com/pages/".
            $this->config['facebook'];
        }
    }

    public function getTwitterUrl()
    {
        if(isset($this->config['twitter'])){
            return "http://www.twitter.com/#!/".
            $this->config['twitter'];
        }
    }

    public function getSlideshareUrl()
    {
        if(isset($this->config['slideshare'])){
            return "http://www.slideshare.com/".
            $this->config['slideshare'];
        }
    }
    
    public function getMainMenuItems()
    {
    	if(!isset($this->config['main_menu'])){
    		return array();
    	}
    	if(!is_array($this->config['main_menu'])){
    		return array();
    	}
    	return $this->config['main_menu'];
    }
    
    public function wowbilify($str)
    {
		$words = mb_split(" ", $str);
		// $letters = array('o'=>'ö', 'i'=>'ï', 'a'=>'ä', 'e'=>'ë', 'u' => 'ü');
		$letters = array('o'=>'ö');

		foreach($words as $k=>$word){
			$found = false;
			foreach($letters as $from=>$to){
				if(strpos($word,$to) !== false){
					$found = true;
					break;
				}
			}
			if($found){
				continue;
			}
			foreach($letters as $from=>$to){
				$i = strpos($word,$from);
				if($i !== false){
					$word = substr_replace($word,$to,$i,1);
					break;
				}
			}
			$words[$k] = $word;
		}
    	return implode(" ", $words);
    }
    
    public function getAnalytics($host=null){
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
