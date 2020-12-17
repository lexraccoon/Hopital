<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\ModifierPatientsType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ModifierPatientsController extends AbstractController
{
    /**
     * @Route("/modifier/patients/{id}", name="modifier_patients")
     */
    public function index(UserInterface $user, $id, Request $request, Patient $patient): Response
    {
        $form = $this->createForm(ModifierPatientsType::class, $patient);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('listePatients');
        }

        return $this->render('modifier_patients/index.html.twig', [
            'controller_name' => 'ModifierPatientsController',
            'form' => $form->createView(),
            'gradeUser' => $user->Grade,
        ]);
    }
}
