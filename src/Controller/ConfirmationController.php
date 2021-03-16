<?php

namespace App\Controller;

use App\Entity\RDV;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ConfirmationController extends AbstractController
{
    /**
     * @Route("/confirmation/{etatRdv}/{id}", name="confirmation")
     */
    public function index($etatRdv, $id, UserInterface $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $rdv = $entityManager->getRepository(RDV::class)->find($id);

        $rdv->setEtatRDV($etatRdv);
        $entityManager->flush();

        return $this->render('confirmation/index.html.twig', [
            'controller_name' => 'ConfirmationController',
            'etatRdv' => $etatRdv,
            'gradeUser' => $user->Grade,
        ]);
    }
}
