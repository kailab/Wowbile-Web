<?php

namespace Wowbile\Bundle\EntityBundle\Repository;

use Kailab\Bundle\SharedBundle\Repository\EntityRepository;

class LinkRepository extends EntityRepository
{	
	public function findForHomepage($locale=null)
	{
		$sql = 'WHERE e.active = true AND e.homepage = true';
		if($locale){
			$sql .= " AND ( e.language IS NULL OR e.language = '' OR e.language = :language )";
		}
		return $this->createEntityQuery($sql)
			->setParameter('language', $locale)->execute();
	}
}
