<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationPatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomPatient', TextType::class, ['label' => 'Nom :', 'attr' => array('class' => 'form-control')])
            ->add('PrenomPatient', TextType::class, ['label' => 'Prénom :', 'attr' => array('class' => 'form-control')])
            ->add('NumeroDeSecu', IntegerType::class, [
                'label' => 'Numéro de sécurité sociale :',
                'attr' => array('class' => 'form-control'),
            ])
            ->add('DateDeNaissance', DateType::class, [
                'label' => 'Date de naissance :',
                'attr' => array('class' => 'form-control'),
                'placeholder' => [
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                ],
                'widget' => 'single_text',
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
