<?php

namespace App\Controller;

use App\Entity\Lit;
use App\Entity\SejourPatient;
use App\Entity\Service;
use App\Form\LitType;
use App\Entity\Patient;
use App\Form\AjouterSejourType;
use App\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class AjouterSejoursController extends AbstractController
{
    /**
     * @Route("/ajouter/sejours/{id}", name="ajouter_sejours")
     */
    public function index(UserInterface $user, $id, Request $request): Response
    {
        $sejour = new SejourPatient();

        $form = $this->createForm(AjouterSejourType::class, $sejour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $idPatient = intval($id);

            #Récupère le plus petit ID d'un lit disponible
            $queryGetIdLit = $this->getDoctrine()
                ->getRepository(SejourPatient::class)
                ->getIdLit();

            $idLit = intval($queryGetIdLit);

            #Rendre ce lit indisponible
            $queryMakeLitIndisponible = $this->getDoctrine()
                ->getRepository(SejourPatient::class)
                ->makeLitIndisponible($idLit);

            $entityManager = $this->getDoctrine()->getManager();

            $sejour->setIdPatient($idPatient);
            $sejour->setNumeroLit($idLit);

            $entityManager->persist($sejour);
            $entityManager->flush();

            return $this->redirectToRoute('listeSejourPatients', array('id' => $id));
        }

        return $this->render('ajouter_sejours/index.html.twig', [
            'controller_name' => 'AjouterSejoursController',
            'form' => $form->createView(),
            'gradeUser' => $user->Grade,
            'id' => $id,
        ]);
    }
}
