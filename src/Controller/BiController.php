<?php

namespace App\Controller;

use App\Entity\Bi;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\BiFormType;
use Symfony\Component\HttpFoundation\Request;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;

class BiController extends AbstractController
{
    private $em;
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/bi', name: 'app_bi')]
    public function index(Request $request, UploadableManager $uploadableManager): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN_EVENT');
        $bi = new Bi();
        $form = $this->createForm(BiFormType::class, $bi);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->em->persist($bi);
            $uploadableManager->markEntityToUpload($bi, $form->get('myFile')->getData());
            $this->em->flush();
            return $this->redirectToRoute('app_user');


        }

        return $this->render('bi/index.html.twig', [
            'BiForm' => $form->createView(),
        ]);
    }
}
