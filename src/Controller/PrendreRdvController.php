<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\Patient;
use App\Form\RechercheMedecinType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class PrendreRdvController extends AbstractController
{
    /**
     * @Route("/prendre/rdv", name="prendre_rdv")
     */
    public function index(UserInterface $user2, Request $request): Response
    {
        $foo = False;
        $medecin = new Medecin();

        $form = $this->createForm(RechercheMedecinType::class, $medecin);
        $form->handleRequest($request);

        $medecinRecherche = [];

        $queryMedecins = $this->getDoctrine()
            ->getRepository(Medecin::class)
            ->findAll();

        if($form->isSubmitted() && $form->isValid())
        {
            $foo = True;
            $nomMedecin = $medecin->getNomMedecin();
            $prenomMedecin = $medecin->getPrenomMedecin();
            $specialiteMedecin = $medecin->getSpecialiteMedecin();

            if($nomMedecin != "" && $prenomMedecin != "" && $specialiteMedecin != "")
            {
                $medecinRecherche = $this->getDoctrine()->getRepository(Medecin::class)->findBy(['NomMedecin' => $nomMedecin, 'PrenomMedecin' => $prenomMedecin, 'SpecialiteMedecin' => $specialiteMedecin]);
            }
            elseif($nomMedecin != "" && $specialiteMedecin != "")
            {
                $medecinRecherche = $this->getDoctrine()->getRepository(Medecin::class)->findBy(['NomMedecin' => $nomMedecin, 'SpecialiteMedecin' => $specialiteMedecin]);
            }
            elseif($nomMedecin != "" && $prenomMedecin != "")
            {
                $medecinRecherche = $this->getDoctrine()->getRepository(Medecin::class)->findBy(['NomMedecin' => $nomMedecin, 'PrenomMedecin' => $prenomMedecin]);
            }
            elseif($prenomMedecin != "" && $specialiteMedecin != "")
            {
                $medecinRecherche = $this->getDoctrine()->getRepository(Medecin::class)->findBy(['PrenomMedecin' => $prenomMedecin, 'SpecialiteMedecin' => $specialiteMedecin]);
            }
            elseif($nomMedecin != "")
            {
                $medecinRecherche = $this->getDoctrine()->getRepository(Medecin::class)->findBy(['NomMedecin' => $nomMedecin]);
            }
            elseif($specialiteMedecin != "")
            {
                $medecinRecherche = $this->getDoctrine()->getRepository(Medecin::class)->findBy(['SpecialiteMedecin' => $specialiteMedecin]);
            }
            elseif($prenomMedecin != "")
            {
                $medecinRecherche = $this->getDoctrine()->getRepository(Medecin::class)->findBy(['PrenomMedecin' => $prenomMedecin]);
            }
            else
            {
                $medecinRecherche = $this->getDoctrine()->getRepository(Medecin::class)->findAll();
            }
        }

        return $this->render('prendre_rdv/index.html.twig', [
            'controller_name' => 'PrendreRdvController',
            'queries' => $queryMedecins,
            'gradeUser' => $user2->Grade,
            'form' => $form->createView(),
            'medecins' => $medecinRecherche,
            'foo' => $foo,
        ]);
    }
}
