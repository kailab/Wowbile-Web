<?php

namespace Wowbile\Bundle\EntityBundle\Repository;

use Kailab\Bundle\SharedBundle\Repository\EntityRepository;

class LinkRepository extends EntityRepository
{	
	public function findForHomepage()
	{
		$sql = 'WHERE e.active = true AND e.homepage = true';
		return $this->createEntityQuery($sql)->execute();
	}
}
