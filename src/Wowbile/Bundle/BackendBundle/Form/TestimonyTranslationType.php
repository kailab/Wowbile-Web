<?php

namespace Wowbile\Bundle\BackendBundle\Form;

use Symfony\Component\Form\FormBuilder;

class TestimonyTranslationType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('locale','hidden');

        $builder->add('description','textarea', array(
            'required'  => false,
        ));
    }
}

