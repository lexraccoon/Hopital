<?php

namespace App\Controller;

use App\Entity\Patient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientsController extends AbstractController
{
    /**
     * @Route("/patients", name="patients")
     */
    public function index(): Response
    {
        $query = $this->getDoctrine()
            ->getRepository(Patient::class)
            ->findAll();

        return $this->render('patients/index.html.twig', [
            'controller_name' => 'PatientsController',
            'queries' => $query,
        ]);
    }
}
