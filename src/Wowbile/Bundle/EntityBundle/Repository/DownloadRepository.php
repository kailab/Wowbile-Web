<?php

namespace Wowbile\Bundle\EntityBundle\Repository;

use Wowbile\Bundle\EntityBundle\Entity\Concept;

use Kailab\Bundle\SharedBundle\Repository\EntityRepository;

class DownloadRepository extends EntityRepository
{
	public function findForHomepage()
	{
		$sql = "WHERE e.active = true AND e.type = 'ppt'";
		return $this->createEntityQuery($sql)->getOneOrNullResult();
	}
}
