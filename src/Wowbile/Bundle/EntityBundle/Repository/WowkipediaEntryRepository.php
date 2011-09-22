<?php

namespace Wowbile\Bundle\EntityBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;

use Kailab\Bundle\SharedBundle\Repository\EntityRepository;

class WowkipediaEntryRepository extends EntityRepository
{
	public function findForHomepage()
	{
		$sql = 'WHERE e.active = true AND e.homepage = true';
		return $this->createEntityQuery($sql)
		->execute();
	}
	
	public function findActiveByName($name)
	{
		$sql = 'JOIN e.translations t WHERE e.active = true AND t.name = :name';
		return $this->createEntityQuery($sql)
		->setParameter('name',$name)->getOneOrNullResult();
	}
	
	public function groupByColumns($entries, $num=1)
	{
		if($entries instanceof ArrayCollection){
			$entries = $entries->toArray();
		}
		$len = count($entries);
		$part = ceil($len/$num);
		$columns = array();
		for($pos=0;$pos<$len;$pos+=$part){
			$column = array_slice($entries, $pos, $part);
			$columns[] = new ArrayCollection($column);
		}
		return $columns;
	}
	
	public function groupByLetters($entries, $columns=1)
	{
		$groups = array();
		foreach($entries as $entry){
			$letter = $entry->getLetter();
			if(!isset($groups[$letter])){
				$groups[$letter] = new ArrayCollection();
			}
			$groups[$letter]->add($entry);
		}
		if($columns>1){
			foreach($groups as $k=>$entries){
				$groups[$k] = $this->groupByColumns($entries,$columns);
			}
		}
		return $groups;
	}
}
