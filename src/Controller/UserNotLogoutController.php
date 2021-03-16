<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserNotLogoutController extends AbstractController
{
    /**
     * @Route("/user/not/logout", name="user_not_logout")
     */
    public function index(): Response
    {
        return $this->render('user_not_logout/index.html.twig', [
            'controller_name' => 'UserNotLogoutController',
        ]);
    }
}
