<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class EventController extends AbstractController
{
    #[Route('/', name: 'app_events')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    
    #[Route('/create', name: 'app_create')]
    #[IsGranted('ROLE_ADMIN_EVENT')]
    public function create(): Response
    {
        return $this->render('create.html.twig');
    }

}   
