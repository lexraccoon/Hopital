<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecherchePatientsController extends AbstractController
{
    /**
     * @Route("/recherche/patients", name="recherche_patients")
     */
    public function index(): Response
    {
        return $this->render('recherche_patients/index.html.twig', [
            'controller_name' => 'RecherchePatientsController',
        ]);
    }
}
