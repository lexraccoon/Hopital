<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\RecherchePatientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ListePatientsController extends AbstractController
{
    /**
     * @Route("/liste/patients", name="liste_patients")
     */
    public function index(UserInterface $user, Request $request): Response
    {

        $patient = new Patient();

        $form = $this->createForm(RecherchePatientType::class, $patient);
        $form->handleRequest($request);

        $patientRecherche = [];

        if($form->isSubmitted() && $form->isValid())
        {
            $nomPatient = $patient->getNomPatient();
            $prenomPatient = $patient->getPrenomPatient();
            $numeroSecu = $patient->getNumeroDeSecu();
            $agePatient = $patient->getDateDeNaissance();
            if($nomPatient != "" && $prenomPatient != "")
            {
                $patientRecherche = $this->getDoctrine()->getRepository(Patient::class)->findBy(['NomPatient' => $nomPatient, 'PrenomPatient' => $prenomPatient]);
            }
            elseif($nomPatient != "")
            {
                $patientRecherche = $this->getDoctrine()->getRepository(Patient::class)->findBy(['NomPatient' => $nomPatient]);
            }
            elseif($prenomPatient != "")
            {
                $patientRecherche = $this->getDoctrine()->getRepository(Patient::class)->findBy(['PrenomPatient' => $prenomPatient]);
            }
            elseif($numeroSecu != "")
            {
                $patientRecherche = $this->getDoctrine()->getRepository(Patient::class)->findBy(['NumeroDeSecu' => $numeroSecu]);
            }
            elseif($numeroSecu != "")
            {
                $patientRecherche = $this->getDoctrine()->getRepository(Patient::class)->findBy(['DateDeNaissance' => $agePatient]);
            }
            else
            {
                $patientRecherche = $this->getDoctrine()->getRepository(Patient::class)->findAll();
            }
        }
        else
        {
            $queryPatients = $this->getDoctrine()
                ->getRepository(Patient::class)
                ->findAll();
            return $this->render('liste_patients/index.html.twig', [
                'controller_name' => 'ListePatientsController',
                'gradeUser' => $user->Grade,
                'queries' => $queryPatients,
                'form' => $form->createView(),
                'patients' => $patientRecherche,
            ]);
        }

        return $this->render('liste_patients/index.html.twig', [
            'controller_name' => 'ListePatientsController',
            'gradeUser' => $user->Grade,
            'form' => $form->createView(),
            'patients' => $patientRecherche,
        ]);
    }
}
