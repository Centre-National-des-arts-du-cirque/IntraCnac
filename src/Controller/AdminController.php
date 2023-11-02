<?php

namespace App\Controller;

use App\Repository\BuildingTicketRepository;
use App\Repository\ItTicketRepository;
use App\Repository\TicketRepository;
use App\Repository\VehicleTicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

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

        $tickets = $tr->findBy([], ['date' => 'DESC', 'solved' => 'ASC']);

        return $this->render('admin/index.html.twig', [
            'tickets' => $tickets,
        ]);
    }

    #[Route('/admin/chart', name: 'app_admin_chart')]
    public function chart(ChartBuilderInterface $chartBuilder, ItTicketRepository $itTicketRepositoryBuild , BuildingTicketRepository $buildingTicketRepository , VehicleTicketRepository $vehicleTicketRepository): Response
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_PIE);
        $chart->setData([
            'labels' => ['IT', 'Building', 'Vehicle'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [$itTicketRepositoryBuild->count([]), $buildingTicketRepository->count([]), $vehicleTicketRepository->count([])],
                ],
            ],
        ]);

       

        return $this->render('admin/chart.html.twig', [
            'chart' => $chart,
        ]);
    }
}
