<?php

namespace App\Form;

use App\Entity\Personnel;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class AjouterUtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['label' => 'Identifiant:', 'attr' => array('class' => 'manageLastName form-control')])
            ->add('NomUtilisateur', TextType::class, ['label' => 'Nom de l\'Utilisateur:', 'attr' => array('class' => 'manageLastName form-control')])
            ->add('PrenomUtilisateur', TextType::class, ['label' => 'Prénom de l\'Utilisateur:', 'attr' => array('class' => 'manageFirstName form-control')])
            ->add('grade', ChoiceType::class, [
                'choices'  => [
                    'Infirmier' => 'Infirmier',
                    'Secrétaire' => 'Secretaire',
                    'Administrateur' => 'Administrateur',
                ],
                'label' => 'Grade', 'attr' => array('class' => 'custom-select')
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'label' => 'Mot de passe:', 'attr' => array('class' => 'managePassword form-control')
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Personnel::class,
        ]);
    }
}
