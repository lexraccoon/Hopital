<?php

namespace App\Controller;

use App\Entity\Medecin;
use App\Entity\Patient;
use App\Entity\RDV;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class ReservationRdvController extends AbstractController
{
    /**
     * @Route("/reservation/rdv/{id}", name="reservation_rdv")
     */
    public function index($id, UserInterface $user2, Request $request): Response
    {
        /** @var \App\Entity\Utilisateur $user */
        $user = $this->getUser();
        $userId = $user->getId();
        date_default_timezone_set("Europe/Paris");

        $queryNumSecuPatient = $this->getDoctrine()
            ->getRepository(RDV::class)
            ->findNumeroSecu($userId);

        $numSecuPatient = intval($queryNumSecuPatient[0]["NumeroDeSecu"]);
        $patient = $this->getDoctrine()->getRepository(Patient::class)->findBy(['NumeroDeSecu' => $numSecuPatient]);

        $prenomUser = $patient[0]->getPrenomPatient();
        $nomUser = $patient[0]->getNomPatient();

        $medecin = $this->getDoctrine()->getRepository(Medecin::class)->findBy(['id' => $id]);

        $nomMedecin = $medecin[0]->getNomMedecin();
        $prenomMedecin = $medecin[0]->getPrenomMedecin();

        if($request->request->get('medecin')){
            return new JsonResponse($this->getDoctrine()
                ->getRepository(RDV::class)
                ->findRdvTaken($nomMedecin, $prenomMedecin));
        }

        elseif($request->request->get('dateRdv') && $request->request->get('hourRdv')) {
            $dateRdv = $_POST["dateRdv"];
            $hourRdv = $_POST["hourRdv"];

            $date = \DateTime::createFromFormat('d/m/Y', $dateRdv);
            $date->format('d/m/Y');

            $hour = new \DateTime($hourRdv);

            $entityManager = $this->getDoctrine()->getManager();
            $rdv = new RDV();
            $rdv->setPrenomPatient($prenomUser);
            $rdv->setNomPatient($nomUser);
            $rdv->setNumeroDeSecuPatient($numSecuPatient);
            $rdv->setNomMedecin($nomMedecin);
            $rdv->setPrenomMedecin($prenomMedecin);
            $rdv->setDateRDV($date);
            $rdv->setHeureRDV($hour);
            $rdv->setEtatRDV("Demandé");
            $entityManager->persist($rdv);
            $entityManager->flush();
        }

        return $this->render('reservation_rdv/index.html.twig', [
            'controller_name' => 'ReservationRdvController',
            'gradeUser' => $user2->Grade,
        ]);
    }
}
