<?php

namespace App\Controller;

use App\Entity\SejourPatient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ListeSejourPatientsController extends AbstractController
{
    /**
     * @Route("/liste/sejour/patients/{id}", name="liste_sejour_patients")
     */
    public function index(UserInterface $user, $id): Response
    {
        $idPatient = intval($id);

        $em = $this->getDoctrine()->getManager();
        $querySejours = $em->getRepository(SejourPatient::class)->findBy(array('IdPatient' => $idPatient));



        return $this->render('liste_sejour_patients/index.html.twig', [
            'controller_name' => 'ListeSejourPatientsController',
            'gradeUser' => $user->Grade,
            'queries' => $querySejours,
            'id' => $id,
        ]);
    }
}
