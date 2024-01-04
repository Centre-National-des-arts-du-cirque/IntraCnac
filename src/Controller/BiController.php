<?php

namespace App\Controller;

use App\Entity\Bi;
use App\Form\BiFormType;
use App\Repository\BiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class BiController extends AbstractController
{
    private $em;
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->tokenStorage = $tokenStorage;
    }

    #[Route('/bi', name: 'app_bi_create')]
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

            return $this->redirectToRoute('app_index');
        }

        return $this->render('bi/create.html.twig', [
            'BiForm' => $form->createView(),
        ]);
    }

    #[Route('/bi/update/{id}', name: 'app_bi_update', requirements: ['id' => '\d+'])]
    public function update(Request $request, UploadableManager $uploadableManager, BiRepository $biRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN_EVENT');
        $bi = $biRepository->findBy(['id' => $request->attributes->get('id')]);
        $form = $this->createForm(BiFormType::class, $bi[0]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($bi[0]);
            $uploadableManager->markEntityToUpload($bi[0], $form->get('myFile')->getData());
            $this->em->flush();

            return $this->redirectToRoute('app_admin_bi');
        }

        return $this->render('bi/update.html.twig', [
            'BiForm' => $form->createView(),
        ]);
    }

    #[Route('/bi/delete/{id}', name: 'app_bi_delete', requirements: ['id' => '\d+'])]
    public function delete(Request $request, BiRepository $biRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN_EVENT');
        $bi = $biRepository->findBy(['id' => $request->attributes->get('id')]);
        $this->em->remove($bi[0]);
        $this->em->flush();

        return $this->redirectToRoute('app_admin_bi');
    }
}
