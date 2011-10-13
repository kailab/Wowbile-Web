<?php

namespace Kailab\Bundle\SharedBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpFoundation\Request;

/**
 * A listener that will check if the user agent is a mobile version
 * and will redirect to a different bundle if so.
 */
class MobileVersion
{
	protected $bundle = null;
	
	public function __construct($bundle)
	{
		$this->bundle = $bundle;
	}
	
	public function isMobile(Request $request)
	{
		if($request->query->has("mobile")){
			return $request->query->get("mobile") == true;
		}
		if($this->isMobileBot($request)){
			return true;
		}
		
		$op = $request->headers->get('x-operamini-phone');
		$ua = mb_strtolower($request->headers->get('user-agent'));
		$ac = $request->headers->get('accept');

		return strpos($ac, 'application/vnd.wap.xhtml+xml') !== false
		|| $op != ''
		|| strpos($ua, 'android') !== false
		|| strpos($ua, 'iphone') !== false
		|| strpos($ua, 'sony') !== false
		|| strpos($ua, 'symbian') !== false
		|| strpos($ua, 'nokia') !== false
		|| strpos($ua, 'samsung') !== false
		|| strpos($ua, 'mobile') !== false
		|| strpos($ua, 'windows ce') !== false
		|| strpos($ua, 'epoc') !== false
		|| strpos($ua, 'opera mini') !== false
		|| strpos($ua, 'nitro') !== false
		|| strpos($ua, 'j2me') !== false
		|| strpos($ua, 'midp-') !== false
		|| strpos($ua, 'cldc-') !== false
		|| strpos($ua, 'netfront') !== false
		|| strpos($ua, 'mot') !== false
		|| strpos($ua, 'up.browser') !== false
		|| strpos($ua, 'up.link') !== false
		|| strpos($ua, 'audiovox') !== false
		|| strpos($ua, 'blackberry') !== false
		|| strpos($ua, 'ericsson,') !== false
		|| strpos($ua, 'panasonic') !== false
		|| strpos($ua, 'philips') !== false
		|| strpos($ua, 'sanyo') !== false
		|| strpos($ua, 'sharp') !== false
		|| strpos($ua, 'sie-') !== false
		|| strpos($ua, 'portalmmm') !== false
		|| strpos($ua, 'blazer') !== false
		|| strpos($ua, 'avantgo') !== false
		|| strpos($ua, 'danger') !== false
		|| strpos($ua, 'palm') !== false
		|| strpos($ua, 'series60') !== false
		|| strpos($ua, 'palmsource') !== false
		|| strpos($ua, 'pocketpc') !== false
		|| strpos($ua, 'smartphone') !== false
		|| strpos($ua, 'rover') !== false
		|| strpos($ua, 'ipaq') !== false
		|| strpos($ua, 'au-mic,') !== false
		|| strpos($ua, 'alcatel') !== false
		|| strpos($ua, 'ericy') !== false
		|| strpos($ua, 'up.link') !== false
		|| strpos($ua, 'vodafone/') !== false
		|| strpos($ua, 'wap1.') !== false
		|| strpos($ua, 'wap2.') !== false;
	}
	
	public function isMobileBot(Request $request)
	{
		$ua = mb_strtolower($request->headers->get('user-agent'));
		$ip = $request->headers->get('Remote-Address');
		return  strpos($ua, 'googlebot-mobile') !== false
		|| strpos($ua, 'nokia6230i/. fast crawler') !== false;
	}
	
	public function getMobileController($controller)
	{
		$controller = explode("::", $controller);
		$controller[0] = explode("\\", $controller[0]);
		$controller[0] = $this->bundle."\\Controller\\".end($controller[0]);
		return implode("::", $controller);
	}
	
	public function onKernelRequest(GetResponseEvent $event)
	{
		$request = $event->getRequest();
		if($this->bundle && $this->isMobile($request)){
			if($request->attributes->has('_controller')){
				// exchange the controller for the mobile one
				$controller = $request->attributes->get('_controller');
				$controller = $this->getMobileController($controller);
				$request->attributes->set('_controller', $controller);
			}
		}
	}
	
}