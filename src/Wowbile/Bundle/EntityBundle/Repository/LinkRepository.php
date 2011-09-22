<?php

namespace Wowbile\Bundle\EntityBundle\Repository;

use Kailab\Bundle\SharedBundle\Repository\EntityRepository;

class LinkRepository extends EntityRepository
{	
	public function findForHomepage()
	{
		return $this->createEntityQuery('WHERE e.active = true AND e.homepage = true')
		->execute();
	}
}
