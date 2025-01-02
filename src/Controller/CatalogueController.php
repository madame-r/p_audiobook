<?php

namespace App\Controller;

use App\Repository\AudiobooksRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Symfony\Component\HttpFoundation\Request;

class CatalogueController extends AbstractController
{
    #[Route('/', name: 'app_catalogue')]
    public function index(Request $request, AudiobooksRepository $audiobooksRepository): Response
    {


        // Get the search term from the query parameter
        $searchTerm = $request->query->get('search', '');

        // Fetch audiobooks based on the search term
        if ($searchTerm) {
            $audiobooks = $audiobooksRepository->searchByTitle($searchTerm);
        } else {
            // If no search term is provided, fetch all audiobooks
            $audiobooks = $audiobooksRepository->findAll();
        }





        // Prepare carousel data
        $carouselData = [];
        foreach ($audiobooks as $audiobook) {
            $carouselData[] = [
                'id' => $audiobook->getId(),
                'title' => $audiobook->getTitle(),
                'imageName' => '/upload/audiobooks_covers/' . $audiobook->getImageName(),
            ];
        }

        // Render the catalogue template and pass the audiobooks data
        return $this->render('catalogue/index.html.twig', [
            'audiobooks' => $audiobooks,
            'carouselData' => $carouselData,
            'searchTerm' => $searchTerm,
        ]);
    }
}
