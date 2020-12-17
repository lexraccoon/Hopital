<?php

namespace App\Controller;

use App\Entity\Personnel;
use App\Form\AjouterUtilisateurType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class AjouterUtilisateursController extends AbstractController
{
    /**
     * @Route("/ajouter/utilisateurs", name="app_register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder, UserInterface $user): Response
    {
        $newUser = new Personnel();
        $form = $this->createForm(AjouterUtilisateurType::class, $newUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $newUser->setPassword(
                $passwordEncoder->encodePassword(
                    $newUser,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newUser);
            $entityManager->flush();

            return $this->redirectToRoute('ajouterUtilisateurs');
        }

        return $this->render('ajouter_utilisateurs/index.html.twig', [
            'controller_name' => 'AjouterUtilisateursController',
            'form' => $form->createView(),
            'gradeUser' => $user->Grade,
        ]);
    }
}
