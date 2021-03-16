<?php

namespace App\Form;

use App\Entity\Medecin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheMedecinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('NomMedecin', SearchType::class, ['required' => false, 'attr' =>  array('class'=>'form-control','placeholder' => 'Nom')])
            ->add('PrenomMedecin', SearchType::class, ['required' => false ,'attr' =>  array('class'=>'form-control','placeholder' => 'Prénom')])
            ->add('SpecialiteMedecin', SearchType::class, ['required' => false ,'attr' =>  array('class'=>'form-control','placeholder' => 'Spécialité')])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medecin::class,
        ]);
    }
}
