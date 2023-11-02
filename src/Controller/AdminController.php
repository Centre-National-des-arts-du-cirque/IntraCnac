<?php

namespace App\Controller;

use App\Repository\TicketRepository;
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

        $tickets = $tr->findBy([],['date' => 'DESC', 'solved' => 'ASC']);
        return $this->render('admin/index.html.twig', [
            'tickets' => $tickets,
        ]);
    }
    #[Route('/admin/chart', name: 'app_admin_chart')]
    public function chart(ChartBuilderInterface $chartBuilder):Response
    {   
        $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        $chart->setData([
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [0, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ]);

        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,
                    'suggestedMax' => 100,
                ],
            ],
        ]);

        return $this->render('admin/chart.html.twig', [
            'chart' => $chart,
        ]);
    }
}
