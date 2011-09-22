<?php

namespace Wowbile\Bundle\BackendBundle\Form;

use Symfony\Component\Form\FormBuilder;

class TestimonyType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        
    	$builder->add('name','text',array(
    	    'required'  => true,
    	));
    	
    	$builder->add('company','text',array(
    		'required'  => false,
    	));
    	
    	$builder->add('url','url',array(
    	    'required'  => false,
    	));
    	
    	$builder->add('image','file',array(
    	    	    'required'  => false,
    	));
    	 
        $builder->add('translations', 'collection', array(
            'type'       => new TestimonyTranslationType(),
        ));
    }
}

