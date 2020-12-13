<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GererPatientsController extends AbstractController
{
    /**
     * @Route("/gerer/patients", name="gerer_patients")
     */
    public function index(): Response
    {
        return $this->render('gerer_patients/index.html.twig', [
            'controller_name' => 'GererPatientsController',
        ]);
    }
}
