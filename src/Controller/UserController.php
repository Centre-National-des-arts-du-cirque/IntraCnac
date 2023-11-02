<?php

namespace App\Controller;

use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class UserController extends AbstractController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }
    #[Route('/profil', name: 'app_user')]
    public function redirection(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_admin');
        }
        else {
            return $this->redirectToRoute('app_user_profil');
        }
    }
    #[Route('/monprofil',name:'app_user_profil')]
    public function index(TicketRepository $ticketRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $tickets = $ticketRepository->findBy(['createBy'=>$this->getUser()], ['date' => 'DESC','solved' => 'ASC']);
        
        return $this->render('user/index.html.twig',[
            'tickets' => $tickets
        ]);
    }

}
