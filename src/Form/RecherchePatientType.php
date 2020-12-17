<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecherchePatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomPatient', SearchType::class, ['required' => false, 'attr' =>  array('class'=>'form-control','placeholder' => 'Nom')])
            ->add('PrenomPatient', SearchType::class, ['required' => false ,'attr' =>  array('class'=>'form-control','placeholder' => 'Prénom')])
            ->add('NumeroDeSecu', SearchType::class, ['required' => false ,'attr' =>  array('class'=>'form-control','placeholder' => 'N° de sécurité sociale')])
            ->add('DateDeNaissance', SearchType::class, ['required' => false ,'attr' =>  array('class'=>'form-control','placeholder' => 'Date de naissance')])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
