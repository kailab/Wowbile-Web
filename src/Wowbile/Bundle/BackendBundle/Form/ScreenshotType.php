<?php

namespace Wowbile\Bundle\BackendBundle\Form;

use Symfony\Component\Form\FormBuilder;
use Wowbile\Bundle\EntityBundle\Entity\Screenshot;

class ScreenshotType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('id','hidden');
        $builder->add('orientation', 'choice', array(
            'choices'   => array(
                Screenshot::ORIENTATION_VERTICAL    => 'Vertical',
                Screenshot::ORIENTATION_HORIZONTAL  => 'Horizontal'
            )
        ));
        $builder->add('platform', 'entity', array(
            'class'     => 'Wowbile\\Bundle\\EntityBundle\\Entity\\Platform',
            'property'  => 'name',
            'expanded'  => false,
            'required'  => true
        ));
        $builder->add('image','file',array(
            'required'  => false,
        ));
    }

}

