<?php

namespace Wowbile\Bundle\EntityBundle\Repository;

use Wowbile\Bundle\EntityBundle\Entity\Testimony;

use Kailab\Bundle\SharedBundle\Repository\EntityRepository;

class TestimonyRepository extends EntityRepository
{
	/**
	 * 
	 * @return Testimony
	 */
	public function findFeatured()
	{
		$sql = 'WHERE e.active = true';
        return $this->createEntityQuery($sql)->getOneOrNullResult();
	}
}
