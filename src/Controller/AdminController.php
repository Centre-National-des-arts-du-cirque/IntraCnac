<?php

namespace App\Controller;

use App\Repository\BuildingTicketRepository;
use App\Repository\ItTicketRepository;
use App\Repository\TicketRepository;
use App\Repository\VehicleTicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $user = $this->tokenStorage->getToken()->getUser();
        $tickets = $tr->findBy([], ['solved' => 'ASC', 'date' => 'DESC']);

        return $this->render('admin/index.html.twig', [
            'tickets' => $tickets,
            'user' => $user
        ]);
    }

    #[Route('/admin/chart/', name: 'app_admin_chart')]
    public function chart(Request $request,ChartBuilderInterface $chartBuilder, ItTicketRepository $itTicketRepository , BuildingTicketRepository $buildingTicketRepository , VehicleTicketRepository $vehicleTicketRepository, TicketRepository $ticketRepository,): Response
    {   
       $this->denyAccessUnlessGranted('ROLE_ADMIN');
       if($request->query->get('yearSelector') == null or $request->query->get('yearSelector') == 'now'){
            $year = date('Y');
        }
        else{
            $year = $request->query->get('yearSelector');
        }
        if($request->query->get('monthSelector') == null or $request->query->get('monthSelector') == 'now'){
            $month = date('m');
        }
        else{
            $month = $request->query->get('monthSelector');
        }

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
        $nbOfItTicket = $itTicketRepository->countByDate($startOfActualYear,$endOfActualYear);
        $nbOfBuildingTicket =$buildingTicketRepository->countByDate($startOfActualYear , $endOfActualYear );
        $nbOfVehicleTicket =  $vehicleTicketRepository->countByDate($startOfActualYear , $endOfActualYear );

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
            'labels' =>['Direction','Comptabilité','Ressources Humaines','Batiment et Infrastructure','Communication','Accueil','Centre de ressources','FTLV'],
            'datasets'=>[
                [
                    'label' => 'My First dataset',
                    'backgroundColor'=> ['rgb(255, 99, 132)','rgb(54, 162, 235)','rgb(255, 205, 86)','rgb(75, 192, 192)','rgb(153, 102, 255)','rgb(255, 159, 64)','rgb(255, 99, 132)','rgb(54, 162, 235)'],
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [$ticketRepository->CountByServiceAndDate('Direction' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Comptabilité' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Ressources Humaines' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Technique' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Communication' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Accueil' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('Centre de ressource' , $startOfActualYear , $endOfActualYear),$ticketRepository->CountByServiceAndDate('FTLV' , $startOfActualYear , $endOfActualYear)]    
                ]
            ]

            
        ]);
        $allTicketByTypechart->setData([
            'labels' => ['IT', 'Building', 'Vehicle'],
            'datasets' => [
                [
                    'label' => 'Nombre de ticket en fonction du type',
                    'backgroundColor' => ['rgb(255, 99, 132)', 'rgb(54, 162, 235)', 'rgb(255, 205, 86)'],
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [$nbOfItTicket , $nbOfBuildingTicket , $nbOfVehicleTicket],
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
                    'label' => 'nombre de ticket par jour du mois',
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
            'chart4' => $SolvedAndUnsolvedTicketByDate,
            'nbticket' =>  $nbOfItTicket + $nbOfBuildingTicket + $nbOfVehicleTicket,
            'year'=> $year, 
        ]);
    }
}
