<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class UserController extends AbstractController
{
    private ManagerRegistry $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    #[Route('/profile', name: 'app_profile')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/sign', name: 'app_signature')]
    public function signe(): Response
    {
        $user = $this->getUser();

        if(!$user) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('user/sign.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/update-sign', name: 'app_update_signature')]
    public function updateSign() : Response
    {
        $user = $this->getUser();
        $user->setIsSign(true);
        $this->doctrine->getManager()->flush();
        
        return $this->redirectToRoute('app_signature');
    }
}
