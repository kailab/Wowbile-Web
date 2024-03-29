<?php

namespace Wowbile\Bundle\BackendBundle\Form;

use Symfony\Component\Form\FormBuilder;

class WowkipediaEntryTranslationType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        // $builder->add('id','hidden');
        $builder->add('locale','hidden');
        $builder->add('name','text',array(
            'required'  => true,
        ));

        $builder->add('description','textarea', array(
            'required'  => false,
        ));
    }
}

