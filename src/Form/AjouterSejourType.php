<?php

namespace App\Form;

use App\Entity\SejourPatient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjouterSejourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DateEntree', DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Date d\'entrée','attr' => array('class' => 'manageDateEntree form-control')])
            ->add('DateSortie', DateType::class, [
                'required' => false,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'label' => 'Date de sortie','attr' => array('class' => 'manageDateSortie form-control')])
            ->add('submit', SubmitType::class, ['label' => 'Ajouter un séjour', 'attr' => array('class' => 'btn btn-primary')])
            ->add('NomService', ChoiceType::class, [
                'choices'  => [
                    'Cardio' => 'Cardio',
                    'Réanimation' => 'Réanimation',
                    'Neurologie' => 'Neurologie',
                    'Pneumologie' => 'Pneumologie',
                ],
                'label' => 'Service', 'attr' => array('class' => 'custom-select')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SejourPatient::class,
        ]);
    }
}
