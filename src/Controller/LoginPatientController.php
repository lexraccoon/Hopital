<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginPatientController extends AbstractController
{
    /**
     * @Route("/login_patient", name="app_login_patient")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $user = new Utilisateur();

        return $this->render('security/login_patient.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'gradeUser' => $user->Grade
        ]);
    }
}
