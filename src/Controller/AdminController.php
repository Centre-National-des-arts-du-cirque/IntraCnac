<?php

namespace App\Controller;

use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class AdminController extends AbstractController
{
    private $tokenStorage;   
    
    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    #[Route('/admin', name: 'app_admin')]
    public function index(TicketRepository $tr): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $tickets = $tr->findBy([],['date' => 'DESC', 'solved' => 'ASC']);
        return $this->render('admin/index.html.twig', [
            'tickets' => $tickets,
        ]);
    }
}
