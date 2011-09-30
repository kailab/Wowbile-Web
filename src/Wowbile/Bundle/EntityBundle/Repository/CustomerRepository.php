<?php

namespace Wowbile\Bundle\EntityBundle\Repository;

use Wowbile\Bundle\EntityBundle\Entity\CustomerTranslation;

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
		$q = 'DELETE FROM WowbileEntityBundle:CustomerScreenshot s WHERE s.customer = :id';
		return $em->createQuery($q)->setParameter('id',$id)->execute();
	}
	
	public function deleteTranslationLinks(CustomerTranslation $trans)
	{
		$em = $this->getEntityManager();
		$ids = array($trans->getId());
		$q = array("s.translation = ?0");
		$i = 1;
		foreach($trans->getLinks() as $link){
			if($link->getId()){
				$ids[] = $link->getId();
				$q[] = "s.id != ?".$i++;
			}
		}
		$q = 'DELETE FROM WowbileEntityBundle:CustomerTranslationLink s WHERE '
			. implode(" AND ", $q);
		return $em->createQuery($q)->setParameters($ids)->execute();
	}
	
	public function deleteLinks(Customer $customer)
	{
		foreach($customer->getTranslations() as $trans){
			$this->deleteTranslationLinks($trans);
		}
	}	
	
	public function findActiveBySlug($slug)
	{
		return $this->createEntityQuery('WHERE e.active = true AND e.slug = :slug')
		->setParameter('slug', $slug)->getOneOrNullResult();
	}
}
