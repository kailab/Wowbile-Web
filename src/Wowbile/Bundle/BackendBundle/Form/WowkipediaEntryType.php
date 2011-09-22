<?php

namespace Wowbile\Bundle\BackendBundle\Form;

use Symfony\Component\Form\FormBuilder;


class WowkipediaEntryType extends BaseType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        // $builder->add('id','hidden');
        $builder->add('translations', 'collection', array(
            'type'       => new WowkipediaEntryTranslationType(),
        ));
    }

}

