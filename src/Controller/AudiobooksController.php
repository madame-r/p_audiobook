<?php

namespace App\Controller;

use App\Entity\Audiobooks;
use App\Form\AudiobooksType;
use App\Repository\AudiobooksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Vich\UploaderBundle\Templating\Helper\UploaderHelper;



#[Route('/audiobooks')]
final class AudiobooksController extends AbstractController
{
    #[Route(name: 'app_audiobooks_index', methods: ['GET'])]
    public function index(AudiobooksRepository $audiobooksRepository): Response
    {
        return $this->render('audiobooks/index.html.twig', [
            'audiobooks' => $audiobooksRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_audiobooks_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $audiobook = new Audiobooks();
        $form = $this->createForm(AudiobooksType::class, $audiobook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($audiobook);
            $entityManager->flush();

            return $this->redirectToRoute('app_audiobooks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('audiobooks/new.html.twig', [
            'audiobook' => $audiobook,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_audiobooks_show', methods: ['GET'])]
    public function show(Audiobooks $audiobook, UploaderHelper $helper): Response
    {

        // Generate the URL for the cover image
        $coverImagePath = $helper->asset($audiobook, 'imageFile');

        return $this->render('audiobooks/show.html.twig', [
            'audiobook' => $audiobook,
            'coverImagePath' => $coverImagePath,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_audiobooks_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Audiobooks $audiobook, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AudiobooksType::class, $audiobook);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_audiobooks_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('audiobooks/edit.html.twig', [
            'audiobook' => $audiobook,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_audiobooks_delete', methods: ['POST'])]
    public function delete(Request $request, Audiobooks $audiobook, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $audiobook->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($audiobook);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_audiobooks_index', [], Response::HTTP_SEE_OTHER);
    }
}
