<?php

namespace App\Controller;

use App\Entity\Audiobooks;
use App\Entity\Chapters;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;




class PlaybackController extends AbstractController
{
    #[Route('/playback/{id}', name: 'app_playback')]
    public function index($id, EntityManagerInterface $entityManager, Request $request): Response
    {
        // Fetch the audiobook by ID
        $audiobook = $entityManager->getRepository(Audiobooks::class)->find($id);
    
        // Check if the audiobook exists
        if (!$audiobook) {
            throw $this->createNotFoundException('Audiobook not found');
        }
    
        // Fetch chapters related to the audiobook
        $chapters = $entityManager->getRepository(Chapters::class)
            ->findBy(['audiobooks' => $audiobook]);
    
        // Check if chapters exist
        if (!$chapters) {
            throw $this->createNotFoundException('No chapters found for this audiobook');
        }
    
        // dd($chapters);

        // Get the chapter_id from the query string, default to the first chapter if none is selected
        $chapterId = $request->query->get('chapter_id');
        $selectedChapter = null;
    
        if ($chapterId) {
            $selectedChapter = $entityManager->getRepository(Chapters::class)->find($chapterId);
    
            // Check if the selected chapter exists
            if (!$selectedChapter || $selectedChapter->getAudiobooks() !== $audiobook) {
                throw $this->createNotFoundException('Chapter not found for this audiobook');
            }
        }
    
        // If no chapter_id is selected, default to the first chapter
        if (!$selectedChapter) {
            $selectedChapter = $chapters[0];
        }




        $chaptersData = [];
        foreach ($chapters as $chapter) {
            $chaptersData[] = [
                'id' => $chapter->getId(),
                'title' => $chapter->getTitle(),
                'audioUrl' => '/upload/chapters_audios/' . $chapter->getAudioFilename(), // Adjust based on your entity
                'duration' => $chapter->getDuration(), // Add the duration
            ];
        }



    
        return $this->render('playback/index.html.twig', [
            'audiobook' => $audiobook,
            'chapters' => $chaptersData,
            'selectedChapter' => $selectedChapter,
        ]);



    }
    
}
