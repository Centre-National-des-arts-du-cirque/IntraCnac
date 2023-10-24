<?php

namespace App\Controller;

use App\Entity\BuildingTicket;
use App\Entity\ItTicket;
use App\Entity\Ticket;
use App\Entity\VehicleTicket;
use App\Form\Ticket\BuildingTicketFormType;
use App\Form\Ticket\ItTicketFormType;
use App\Form\Ticket\VehicleTicketFormType;
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

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/ItTicket', name: 'app_ItTicket')]
    public function ittTicket(Request $request): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->tokenStorage->getToken()->getUser();

        $itTicket = new ItTicket();
        $form = $this->createForm(ItTicketFormType::class, $itTicket);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $itTicket->setCreateBy($user);
            $itTicket->setSolved(false);

            $this->em->persist($itTicket);
            $this->em->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('ticket/ItTicket/index.html.twig', [
            'ItTicketForm' => $form->createView(),
        ]);
    }

    #[Route('/BuildingTicket', name: 'app_BuildingTicket')]
    public function BuildingTicket(Request $request): Response
    {   
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->tokenStorage->getToken()->getUser();

        $BuildingTicket = new BuildingTicket();
        $form = $this->createForm(BuildingTicketFormType::class, $BuildingTicket);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $BuildingTicket->setCreateBy($user);
            $BuildingTicket->setSolved(false);
            $this->em->persist($BuildingTicket);
            $this->em->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('ticket/BuildingTicket/index.html.twig', [
            'BuildingTicketForm' => $form->createView(),
        ]);
    }

    #[Route('/VehicleTicket', name: 'app_VehicleTicket')]
    public function VehicleTicket(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        $user = $this->tokenStorage->getToken()->getUser();

        $VehicleTicket = new VehicleTicket();
        $form = $this->createForm(VehicleTicketFormType::class, $VehicleTicket);

        $error = 
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $VehicleTicket->setCreateBy($user);
            $VehicleTicket->setSolved(false);
            $this->em->persist($VehicleTicket);
            $this->em->flush();

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('ticket/VehicleTicket/index.html.twig', [
            'VehicleTicketForm' => $form->createView(),
            
        ]);
    }
    #[Route('/ticket/solve/{id}',name:'app_ticket_solved')]
    public function solveTicket(Ticket $ticket)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $ticket->setSolved(true);
        $this->em->persist($ticket);
        $this->em->flush();


        return $this->redirectToRoute('app_admin');
    }
    #[Route('/ticket/delete/{id}',name:'app_ticket_delete')]
    public function deleteTicket(Ticket $ticket)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');
        

        if($ticket->getCreateBy() != $this->getUser())
        {
            return $this->redirectToRoute('app_user_profil');
        }
        $this->em->remove($ticket);
        $this->em->flush();

        return $this->redirectToRoute('app_profil');
    }
}
