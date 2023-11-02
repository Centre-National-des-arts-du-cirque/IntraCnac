<?php

namespace App\Controller;

use App\Repository\BiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class IndexController extends AbstractController
{
    private $em;


    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    #[Route('/', name: 'app_events')]
    #[IsGranted('ROLE_USER')]
    public function index(BiRepository $biRepository): Response
    {
        $week = date("W");

        $BIS = $biRepository->findByWeek(42);
        return $this->render('index.html.twig', [
            'BIS' => $BIS,
            'nbBIS' => count($BIS),
        ]);
    }
}