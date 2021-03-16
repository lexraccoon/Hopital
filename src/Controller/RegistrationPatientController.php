<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\Utilisateur;
use App\Form\RegistrationPatientType;
use App\Form\RegistrationUtilisateurPatientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationPatientController extends AbstractController
{
    /**
     * @Route("/registration/patient", name="registration_patient")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $patient = new Patient();
        $user = new Utilisateur();

        $form_patient = $this->createForm(RegistrationPatientType::class, $patient);
        $form_user = $this->createForm(RegistrationUtilisateurPatientType::class, $user);
        $form_patient->handleRequest($request);
        $form_user->handleRequest($request);

        if ($form_patient->isSubmitted() && $form_patient->isValid() && $form_user->isSubmitted() && $form_user->isValid())
        {
            // encode the plain password
            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form_user->get('plainPassword')->getData()
                )
            );

            $user->setNomUtilisateur(
                $form_patient->get('NomPatient')->getData()
            );

            $user->setPrenomUtilisateur(
                $form_patient->get('PrenomPatient')->getData()
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patient);
            $entityManager->persist($user);
            $entityManager->flush();

            $queries = $this->getDoctrine()
                ->getRepository(Patient::class)
                ->getIdUtilisateurPatient();

            for ($i = 0; $i < count($queries); $i++) {
                $id = $queries[$i]["id"];
                $nom_user = $queries[$i]["NomUtilisateur"];
                $prenom_user = $queries[$i]["PrenomUtilisateur"];
                $this->getDoctrine()
                    ->getRepository(Patient::class)
                    ->setIdUtilisateurPatient($id, $nom_user, $prenom_user);
            }

            return $this->redirectToRoute('login_patient');
        }

        return $this->render('registration_patient/index.html.twig', [
            'controller_name' => 'RegistrationPatientController',
            'form_patient' => $form_patient->createView(),
            'form_user' => $form_user->createView(),
        ]);
    }
}
