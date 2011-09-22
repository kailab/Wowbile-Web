<?php 

namespace Wowbile\Bundle\BackendBundle\Form;

use Kailab\Bundle\SharedBundle\Form\AbstractType;

class BaseType extends AbstractType
{
	public function getDataNamespace()
	{
		return "Wowbile\\Bundle\\EntityBundle\\Entity\\";
	}
	
}

?>