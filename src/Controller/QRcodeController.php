<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QRcodeController extends AbstractController
{
    #[Route('/', name: 'app_q_rcode')]
    public function index(): Response
    {
        return $this->render('q_rcode/index.html.twig', [
            'controller_name' => 'QRcodeController',
        ]);
    }
}
