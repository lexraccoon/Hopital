<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ListeUtilisateursController extends AbstractController
{
    /**
     * @Route("/liste/utilisateurs", name="liste_utilisateurs")
     */
    public function index(UserInterface $user): Response
    {
        $queryPersonnel = $this->getDoctrine()
            ->getRepository(Utilisateur::class)
            ->findAll();

        return $this->render('liste_utilisateurs/index.html.twig', [
            'controller_name' => 'ListeUtilisateursController',
            'gradeUser' => $user->Grade,
            'queries' => $queryPersonnel
        ]);
    }
}
