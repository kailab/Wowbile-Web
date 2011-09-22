<?php

namespace Wowbile\Bundle\BackendBundle\Form;

use Symfony\Component\Form\FormBuilder;

class ConceptType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
      
        $builder->add('url','url',array(
            'required'  => false
        ));
        $builder->add('slug','text',array(
            'required'  => true
        ));
        $builder->add('translations', 'collection', array(
            'type'       => new ConceptTranslationType(),
        ));

        $builder->add('screenshots','entity', array(
            'class'     => 'Wowbile\\Bundle\\EntityBundle\\Entity\\Screenshot',
            'property'  => 'small_uri',
            'expanded'  => false,
            'multiple'  => true,
            'required'  => false
        ));
    }

}

