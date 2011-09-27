<?php

namespace Wowbile\Bundle\EntityBundle\Repository;

use Wowbile\Bundle\EntityBundle\Entity\Concept;

use Kailab\Bundle\SharedBundle\Repository\EntityRepository;

class ConceptRepository extends EntityRepository
{
	public function deleteScreenshots(Concept $concept)
	{
		$id = $concept->getId();
		if(!$id){
			return false;
		}
		$em = $this->getEntityManager();
		$sql = 'delete from WowbileEntityBundle:ConceptScreenshot s where s.concept = :id';
		return $em->createQuery($sql)->setParameter('id',$id)->execute();
	}
	
	public function findActiveBySlug($slug)
	{
		$sql = 'WHERE e.active = true AND e.slug = :slug';
		return $this->createEntityQuery($sql)
		->setParameter('slug',$slug)->getOneOrNullResult();
	}
}
