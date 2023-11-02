<?php

namespace App\Controller;

use App\Form\XMLCertificationType;
use SimpleXMLElement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class XMLCertificationController extends AbstractController
{
    #[Route('/xmlcertification', name: 'app_x_m_l_certification')]
    public function index(Request $request): Response
    {
        $XMLCertification = <<<XML
        <?xml version="1.0" encoding="UTF-8"?>
        <cpf:flux xmlns:cpf="urn:cdc:cpf:pc5:schema:1.0.0"
        xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
        <cpf:idFlux>drama2022</cpf:idFlux>
        <cpf:horodatage>2020-12-18T14:24:12+01:00</cpf:horodatage>
        <cpf:emetteur>
        <cpf:idClient>03BHY312</cpf:idClient>
        <cpf:certificateurs>
            <cpf:certificateur>
                <cpf:idClient>03BHY312</cpf:idClient>
                <cpf:idContrat>MCFCER000775</cpf:idContrat>
                <cpf:certifications>
                    <cpf:certification>
                        <cpf:type>RS</cpf:type>
                        <cpf:code>RS5286</cpf:code>
                        <cpf:natureDeposant>CERTIFICATEUR</cpf:natureDeposant>
                        <cpf:passageCertifications>
                            
        XML;


        $form = $this->createForm(XMLCertificationType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $csvFile = $form->get('File')->getData()->getPathname();
            $csv = new \ParseCsv\Csv();
            $csv->auto($csvFile);

            foreach ($csv->data as $rowData) {
                $passageCertifications = new SimpleXMLElement('xml/certificationTemplate.xml', dataIsURL: true);
                $passageCertifications->registerXPathNamespace('cpf', 'urn:cdc:cpf:pc5:schema:1.0.0');
                $passageCertifications->xpath('//cpf:passageCertifications');
                $newPassageCertification = $passageCertifications->addChild('cpf:passageCertification');

                $newPassageCertification->addChild('cpf:idTechnique', $rowData['idtechnique']);
                $newPassageCertification->addChild('cpf:obtentionCertification', $rowData['obtention']);
                $newPassageCertification->addChild('cpf:donneeCertifiee', $rowData['donnee certifiee']);
                $newPassageCertification->addChild('cpf:dateDebutValidite', $rowData['Debut de validite']);
                $newPassageCertification->addChild('cpf:dateFinValidite', '')->addAttribute('xsi:nil', 'true');
                $newPassageCertification->addChild('cpf:presenceNiveauLangueEuro', $rowData['Niveau de langue']);
                $newPassageCertification->addChild('cpf:presenceNiveauNumeriqueEuro', $rowData['Niveau numerique europeen']);
                $newPassageCertification->addChild('cpf:scoring', '')->addAttribute('xsi:nil', 'true', 'http://www.w3.org/2001/XMLSchema-instance');
                $newPassageCertification->addChild('cpf:mentionValidee', $rowData['Mention']);

                // Add the modalitesInscription element with its child elements
                $modalitesInscription = $newPassageCertification->addChild('cpf:modalitesInscription');
                $modalitesInscription->addChild('cpf:modaliteAcces', 'FORMATION_CONTINUE_HORS_CONTRAT_DE_PROFESSIONNALISATION');

                // Add the identificationTitulaire element with its child elements
                $identificationTitulaire = $newPassageCertification->addChild('cpf:identificationTitulaire');
                $titulaire = $identificationTitulaire->addChild('cpf:titulaire');
                $titulaire->addChild('cpf:nomNaissance', $rowData['Nom de naissance']);
                $titulaire->addChild('cpf:nomUsage', '')->addAttribute('xsi:nil', 'true', 'http://www.w3.org/2001/XMLSchema-instance');
                $titulaire->addChild('cpf:prenom1', $rowData['Prenom']);
                $titulaire->addChild('cpf:anneeNaissance', $rowData['annee de Naissance']);
                $titulaire->addChild('cpf:moisNaissance', $rowData['mois de naissance']);
                $titulaire->addChild('cpf:jourNaissance', $rowData['jour de naissance']);
                $titulaire->addChild('cpf:sexe', $rowData['sexe']);
                $titulaire->addChild('cpf:codeInsee', $rowData['Code INSEE de la commune ou du pays de naissance']);

                $XMLCertification .= $newPassageCertification->asXML();
            }
            $XMLCertification .= <<<XML
                                    </cpf:passageCertifications>
                    </cpf:certification>
                </cpf:certifications>
            </cpf:certificateur>
        </cpf:certificateurs>
    </cpf:emetteur>

</cpf:flux>
XML;
            $response = new Response($XMLCertification);

            // Set content disposition for download
            $disposition = HeaderUtils::makeDisposition(
                HeaderUtils::DISPOSITION_ATTACHMENT,
                'certificat.xml'
            );
            $response->headers->set('Content-Disposition', $disposition);

            return $response;
        }

        return $this->render('xml_certification/index.html.twig', [
            'XMLCertification' => $form->createView(),
        ]);
    }
}
