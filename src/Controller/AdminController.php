<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine)
    {
    }

    public function someAction()
    {
        // access Doctrine
        $this->doctrine;
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $users = $this->doctrine->getRepository(User::class)->find('ROLE_USER');

        return $this->render('admin/index.html.twig', [
            'users' => $users,
        ]);
    }
}
