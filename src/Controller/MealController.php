<?php

namespace App\Controller;

use App\Repository\OpeningTimeRepository;
use App\Repository\MealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/carte', name:'/carte_')]
class MealController extends AbstractController
{
    #[Route('/', name:'/index')]
    public function index(MealRepository $mealRepository,OpeningTimeRepository $openingTimeRepository): Response
    {
        return $this->render('carte/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'mealMethode'=>$mealRepository->findAll(),
        ]);
    }

}