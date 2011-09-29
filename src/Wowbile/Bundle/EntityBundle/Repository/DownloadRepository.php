<?php

namespace Wowbile\Bundle\EntityBundle\Repository;

use Wowbile\Bundle\EntityBundle\Entity\Concept;

use Kailab\Bundle\SharedBundle\Repository\EntityRepository;

class DownloadRepository extends EntityRepository
{	
	public function findForHomepage($locale=null)
	{
		$sql = "WHERE e.active = true AND e.type = 'ppt'";
		if($locale){
			$sql .= " AND ( e.language IS NULL OR e.language = '' OR e.language = :language )";
		}
		return $this->createEntityQuery($sql)
		->setParameter('language', $locale)->getOneOrNullResult();
	}
	
	public function findActiveById($id)
	{
		$sql = 'WHERE e.active = true AND e.id = :id';
		return $this->createEntityQuery($sql)
		->setParameter('id',$id)->getOneOrNullResult();
	}
}
