<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class XMLCertificationController extends AbstractController
{
    #[Route('/x/m/l/certification', name: 'app_x_m_l_certification')]
    public function index(): Response
    {
        return $this->render('xml_certification/index.html.twig', [
            'controller_name' => 'XMLCertificationController',
        ]);
    }
}
