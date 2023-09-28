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

    #[Route('/admin/chart/{year}/{month}', name: 'app_admin_chart' , requirements: ['year' => '\d{4}','month' => '\d{2}'])]
    public function chart(ChartBuilderInterface $chartBuilder, ItTicketRepository $itTicketRepository , BuildingTicketRepository $buildingTicketRepository , VehicleTicketRepository $vehicleTicketRepository, int $year ,int $month, TicketRepository $ticketRepository): Response
    {   
       
        $startOfActualYear = new \DateTime($year . '-01-01');
        $endOfActualYear = new \DateTime($year . '-12-31');

        $date = [];
        if (in_array($month, [1,3,5,7,8,10,12])) {
           
           for ($i=1; $i < 32; $i++) { 
               
               array_push($date, $i.'-'.$month);
           }
        
        }
        else {
            for ($i=1; $i < 31; $i++) { 
                
                array_push($date, $i.'-'.$month);
            }
        }

        $allTicketByTypechart = $chartBuilder->createChart(Chart::TYPE_PIE);
        $allTicketByService = $chartBuilder->createChart(Chart::TYPE_PIE);
        $allTicketByDate = $chartBuilder->createChart(Chart::TYPE_LINE);
        $SolvedAndUnsolvedTicketByDate =$chartBuilder->createChart(Chart::TYPE_DOUGHNUT);

        var_dump($ticketRepository->countSolvedTicket($startOfActualYear , $endOfActualYear), $ticketRepository->countUnsolvedTicket($startOfActualYear , $endOfActualYear));

        $SolvedAndUnsolvedTicketByDate->setData([
            'labels' => ['Resolu', 'Non Resolu'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => ['rgb(120,190,33)', 'rgb(255, 99, 132)'],
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [$ticketRepository->countSolvedTicket($startOfActualYear , $endOfActualYear)[0][1], $ticketRepository->countUnsolvedTicket($startOfActualYear , $endOfActualYear)[0][1]],
                ],
                
            ],

        ]);

        $allTicketByService->setData([
            'labels' =>['Direction','Comptabilité','Ressources Humaines','Service Technique','Communication','Accueil','Centre de ressource','Autre'],
            'datasets'=>[
                [
                    'label' => 'My First dataset',
                    'backgroundColor'=> ['rgb(255, 99, 132)','rgb(54, 162, 235)','rgb(255, 205, 86)','rgb(75, 192, 192)','rgb(153, 102, 255)','rgb(255, 159, 64)','rgb(255, 99, 132)','rgb(54, 162, 235)'],
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [$ticketRepository->CountByServiceAndDate('Direction' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Comptabilité' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Ressources Humaines' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Technique' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Communication' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Accueil' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Centre de ressource' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Autre' , $startOfActualYear , $endOfActualYear)]    
                ]
            ]

            
        ]);
        $allTicketByTypechart->setData([
            'labels' => ['IT', 'Building', 'Vehicle'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [$itTicketRepository->countByDate($startOfActualYear , $endOfActualYear), $buildingTicketRepository->countByDate($startOfActualYear , $endOfActualYear), $vehicleTicketRepository->countByDate($startOfActualYear , $endOfActualYear)],
                ],
                
            ],
        ]);
        $nbTickets = [];
        for ($i=0; $i <sizeof($date) ; $i++) { 

            $startOfActualYear = date_create($date[$i].'-'.$year);
            $endOfActualYear = date_create($date[$i].'-'.$year);
            
            $nbTicket= $ticketRepository->countByDate($startOfActualYear , $endOfActualYear);

            if ($nbTicket == null) {
                array_push($nbTickets, 0);

            }
            else{
                array_push($nbTickets, $nbTicket);
            }
        }
        
        $allTicketByDate->setData([
            'labels' => $date,
            'datasets'=>[
                [
                    'label' => 'My First dataset',
                    'backgroundColor'=> 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $nbTickets
                ]
            ]
                ]);
        $allTicketByDate->setOptions([
            'scales' => [
                'yAxes' => [
                    'ticks' => [
                        'beginAtZero' => true,
                    ],
                ],[
                    'xAxes' => [
                        'type' => 'time',
                        'time' => [
                            'unit' => 'day'
                        ]
                ]
            ],
        ],
        ]);

       

        return $this->render('admin/chart.html.twig', [
            'chart' => $allTicketByTypechart,
            'chart2'=> $allTicketByService,
            'chart3'=> $allTicketByDate,
            'chart4' => $SolvedAndUnsolvedTicketByDate
        ]);
    }
}
