<?php

namespace App\Controller;

use App\Form\XMLCertificationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class XMLCertificationController extends AbstractController
{
    #[Route('/xmlcertification', name: 'app_x_m_l_certification')]
    public function index(Request $request): Response
    {

        $form = $this->createForm(XMLCertificationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $csvFile = $form->get('File')->getData();
            $csv = new \ParseCsv\Csv();
            $csv->auto($csvFile->getPathname());
            dd($csv->data);
        }
        return $this->render('xml_certification/index.html.twig', [
            'XMLCertification' => $form->createView(),
        ]);
    }
}
