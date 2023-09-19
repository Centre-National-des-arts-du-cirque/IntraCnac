<?php

namespace App\Controller;
use App\Entity\ItTicket;
use App\Form\Ticket\ItTicketFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class TicketController extends AbstractController
{
    private $er;
    private $em;
    private $tokenStorage;

    public function __construct( TokenStorageInterface $tokenStorage, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/ItTicket', name: 'app_ItTicket')]
    public function ittTicket(Request $request): Response
    {   
       $user = $this->tokenStorage->getToken()->getUser();

       $itTicket = new ItTicket();
       $form = $this->createForm(ItTicketFormType::class, $itTicket);
        
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid()) {
            $itTicket->setCreateBy($user);
            $itTicket->setSolved(false);


            $this->em->persist($itTicket);
            $this->em->flush();

            return $this->redirectToRoute('app_login');
        }
        return $this->render('ticket/index.html.twig', [
            'ItTicketForm' => $form->createView(),
        ]);
    }
}
