<?php

namespace Wowbile\Bundle\BackendBundle\Form;

use Symfony\Component\Form\FormBuilder;


class LinkType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('translations', 'collection', array(
            'type'    	=> new LinkTranslationType(),
        ));
        $builder->add('url', 'url', array(
        	'required'	=> true,
        ));
    }

}

