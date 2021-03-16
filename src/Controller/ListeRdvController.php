<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Entity\RDV;
use App\Entity\SejourPatient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class ListeRdvController extends AbstractController
{
    /**
     * @Route("/liste/rdv", name="liste_rdv")
     */
    public function index(UserInterface $user2): Response
    {
        /** @var \App\Entity\Utilisateur $user */
        $user = $this->getUser();
        $userId = $user->getId();
        date_default_timezone_set("Europe/Paris");

        $gradeUser = $user2->Grade;

        //Si l'utilisateur a le role secrétaire, on affiche tous les rendez-vous

        if ($gradeUser == 'Secretaire') {
            $listeRdv = $this->getDoctrine()->getRepository(RDV::class)->findBy(['EtatRDV' => "Demandé"]);

            return $this->render('liste_rdv/index.html.twig', [
                'controller_name' => 'ListeRdvController',
                'rdvs' => $listeRdv,
                'gradeUser' => $gradeUser,
            ]);
        }

        //Sinon, on affiche les rendez-vous correspondants à son numéro de securité social

        else {
            $queryNumSecuPatient = $this->getDoctrine()
                ->getRepository(RDV::class)
                ->findNumeroSecu($userId);

            if ($queryNumSecuPatient == NULL){
                $listeRdv = 0;

                return $this->render('liste_rdv/index.html.twig', [
                    'controller_name' => 'ListeRdvController',
                    'rdvs' => $listeRdv,
                    'gradeUser' => $user2->Grade,
                ]);
            }
            else {
                $NumSecuPatient = intval($queryNumSecuPatient[0]["NumeroDeSecu"]);

                $listeRdv = $this->getDoctrine()->getRepository(RDV::class)->findBy(['NumeroDeSecuPatient' => $NumSecuPatient]);

                if ($listeRdv == NULL){
                    $listeRdv = 0;

                    return $this->render('liste_rdv/index.html.twig', [
                        'controller_name' => 'ListeRdvController',
                        'rdvs' => $listeRdv,
                        'gradeUser' => $user2->Grade,
                    ]);
                }
                else {
                    $etatRdv = $listeRdv[0]->getEtatRDV();

                    $dateRdv = $listeRdv[0]->getDateRDV();
                    $intervalDate = date_diff($dateRdv, new \DateTime("now"));
                    $intIntervalDate = $intervalDate->format('%R%a');

                    $format = 'd-m-Y H:i:s';
                    $heureRdv = $listeRdv[0]->getHeureRDV()->format($format);
                    $heureRdv = \DateTime::createFromFormat($format, $heureRdv);
                    $heureRdv = $heureRdv->format('H:i:s') . "\n";
                    $currentTime = date("H:i:s");

                    if ($etatRdv == 'Validé' && $intIntervalDate >= 0 && $heureRdv > $currentTime) {
                        $entityManager = $this->getDoctrine()->getManager();
                        $rdv = $entityManager->getRepository(RDV::class)->find($listeRdv[0]->getId());

                        $rdv->setEtatRDV("Réalisé");
                        $entityManager->flush();

                        $etatRdv = $listeRdv[0]->getEtatRDV();
                    }


                    return $this->render('liste_rdv/index.html.twig', [
                        'controller_name' => 'ListeRdvController',
                        'rdvs' => $listeRdv,
                        'etatRdv' => $etatRdv,
                        'gradeUser' => $user2->Grade,
                    ]);
                }
            }
        }
    }
}
