<?php

namespace App\Form;

use App\Entity\TimeLine;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TimeLineType extends AbstractType
{
    /**
     * Formulaire ajout de TimeLine
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('events')
            //->add('eras')
            //->add('scale')
            ->add('start_date')
            ->add('end_date')
            ->add('text')
            ->add('media')
            //->add('groups')
            //->add('display_date')
            ->add('background')
            //->add('autolink')
            //->add('unique_id')
            //->add('slug')
            //->add('users')
            //->add('themes')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TimeLine::class,
        ]);
    }
}
