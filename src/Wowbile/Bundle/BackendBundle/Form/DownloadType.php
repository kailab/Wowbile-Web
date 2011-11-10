<?php

namespace Wowbile\Bundle\BackendBundle\Form;

use Symfony\Component\Form\FormBuilder;


class DownloadType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('translations', 'collection', array(
            'type'    	=> new DownloadTranslationType(),
        ));
        $builder->add('type', 'choice', array(
        	'choices'   => array(
            	'homepage'    	=> 'Homepage',
                'other'   		=> 'Other',
        	)
        ));
        $builder->add('language', 'choice', array(
        	'required'	=> false,
            'choices'   => array(
             	'es'    => 'Español',
        		'en'    => 'English',
        	)
        ));
        $builder->add('file','file',array(
            'required'  => false,
        ));
    }

}

