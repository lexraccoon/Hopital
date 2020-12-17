<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\AjouterPatientsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AjouterPatientsController extends AbstractController
{
    /**
     * @Route("/ajouter/patients", name="ajouter_patients")
     */
    public function index(UserInterface $user, Request $request): Response
    {
        $patient = new Patient();

        $form = $this->createForm(AjouterPatientsType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($patient);
            $entityManager->flush();

            return $this->redirectToRoute('listePatients');
        }

        return $this->render('ajouter_patients/index.html.twig', [
            'controller_name' => 'AjouterPatientsController',
            'form' => $form->createView(),
            'gradeUser' => $user->Grade,
        ]);
    }
}
