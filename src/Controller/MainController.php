<?php

namespace App\Controller;

use App\Repository\MealRepository;
use App\Repository\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(OpeningTimeRepository $openingTimeRepository,MealRepository $mealRepository): Response
    {
            return $this->render('main/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'mealMethode'=>$mealRepository->findAll()
        ]);
    }
}
