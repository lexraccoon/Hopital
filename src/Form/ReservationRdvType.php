<?php

namespace App\Form;

use App\Entity\RDV;


use Symfony\Component\Form\AbstractType;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationRdvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DateRDV', ChoiceType::class, ['choices' => [
                'Lundi'=> 'lundi',
                'Mardi'=>'Mardi',
                'Mercredi'=>'Mercredi',
                'Jeudi'=>'Jeudi',
                'Vendredi'=>'Vendredi',

            ],'label'=>'Date du rdv :', 'attr' => array('class'=> 'custom-select')])
            ->add('HeureRDV', TimeType::class, ['label' => 'Heure du rdv : ', 'attr' => array('class' => 'form-control')])
        ;
        echo 'success';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RDV::class,
        ]);
    }
}
