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
        $builder->add('language', 'choice', array(
        	'required'	=> false,
            'choices'   => array(
            	'es'    => 'Español',
               	'en'    => 'Englush',
                ''   	=> 'Any language',
        )
        ));
        $builder->add('image','file',array(
                    	    	    'required'  => false,
        ));
    }

}

