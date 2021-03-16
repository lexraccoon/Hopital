<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WelcomeController extends AbstractController
{
    /**
     * @Route("/", name="welcome")
     */
    public function index(): Response
    {
        $user = new Utilisateur();

        return $this->render('welcome/index.html.twig', [
            'controller_name' => 'WelcomeController',
            'gradeUser' => $user->Grade
        ]);
    }
}
