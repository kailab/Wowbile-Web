<?php

namespace Wowbile\Bundle\EntityBundle\Repository;

use Wowbile\Bundle\EntityBundle\Entity\Customer;

use Kailab\Bundle\SharedBundle\Repository\EntityRepository;

class CustomerRepository extends EntityRepository
{
	public function deleteScreenshots(Customer $customer)
	{
		$id = $customer->getId();
		if(!$id){
			return false;
		}
		$em = $this->getEntityManager();
		$q = 'delete from WowbileEntityBundle:CustomerScreenshot s where s.customer = :id';
		return $em->createQuery($q)->setParameter('id',$id)->execute();
	}
	
	public function findActiveBySlug($slug)
	{
		return $this->createEntityQuery('WHERE e.active = true AND e.slug = :slug')
		->setParameter('slug',$slug)->getOneOrNullResult();
	}
}
