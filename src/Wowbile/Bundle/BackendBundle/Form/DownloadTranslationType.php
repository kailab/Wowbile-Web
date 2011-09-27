<?php

namespace Wowbile\Bundle\BackendBundle\Form;

use Symfony\Component\Form\FormBuilder;

class DownloadTranslationType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder->add('name', 'text', array(
            'required'  => true,
        ));
        $builder->add('description', 'textarea', array(
            'required'  => false,
        ));
    }
}

