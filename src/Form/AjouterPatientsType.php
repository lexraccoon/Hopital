<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjouterPatientsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomPatient', TextType::class, ['label' => 'Nom du patient:', 'attr' => array('class' => 'manageLastName form-control')])
            ->add('PrenomPatient', TextType::class, ['label' => 'Prénom du patient:', 'attr' => array('class' => 'manageFirstName form-control')])
            ->add('DateDeNaissance', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Date de naissance','attr' => array('class' => 'manageDateBirth form-control')])
            ->add('NumeroDeSecu', TextType::class, ['label' => 'Numéro de sécurité sociale:', 'attr' => array('class' => 'manageFirstName form-control')])
            ->add('submit', SubmitType::class, ['label' => 'Ajouter un patient', 'attr' => array('class' => 'btn btn-primary')])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
