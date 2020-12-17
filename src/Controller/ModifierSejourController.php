<?php

namespace App\Controller;

use App\Entity\Lit;
use App\Entity\Patient;
use App\Entity\SejourPatient;
use App\Entity\Service;
use App\Form\LitType;
use App\Form\ModifierPatientsType;
use App\Form\ModifierSejoursType;
use App\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ModifierSejourController extends AbstractController
{
    /**
     * @Route("/modifier/sejour/{idsejour}/{id}", name="modifier_sejour")
     */

    public function index(UserInterface $user, $id, $idsejour, Request $request, SejourPatient $sejourPatient): Response
    {
        $form = $this->createForm(ModifierSejoursType::class, $sejourPatient);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('listeSejourPatients', array('id' => $idsejour));
        }

        return $this->render('modifier_sejour/index.html.twig', [
            'form' => $form->createView(),
            'gradeUser' => $user->Grade,
            'id' => $id,
            'idsejour' => $idsejour,
        ]);
    }
}
