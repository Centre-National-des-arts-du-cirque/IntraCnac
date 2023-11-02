<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class EventController extends AbstractController
{
    private $em;


    public function __construct( EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    #[Route('/', name: 'app_events')]
    public function index(): Response
    {
        return $this->render('Event/index.html.twig');
    }

    
    #[Route('/event/create', name: 'app_create')]
    #[IsGranted('ROLE_ADMIN_EVENT')]
    public function create(Request $request): Response
    {   
        $event = new Event();
        $form = $this->createForm(EventFormType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($event);
            $this->em->flush();
            return $this->redirectToRoute('app_events');
        }

        return $this->render('Event/create.html.twig', 
        [
            'EventForm' => $form->createView(),
        ]);
    }

}   
