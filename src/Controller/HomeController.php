<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\PhotoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(Request $request, PhotoRepository $photoRepository, CategoryRepository $categoryRepository): Response
    {
        $categoryId = $request->query->get('category');

        
        if ($categoryId) {
            $photos = $photoRepository->findBy(['category' => $categoryId]);
        } else {
            $photos = $photoRepository->findAll();
        }

        $categories = $categoryRepository->findAll();

        return $this->render('home/index.html.twig', [
            'photos' => $photos,
            'categories' => $categories,
        ]);
    }
}
