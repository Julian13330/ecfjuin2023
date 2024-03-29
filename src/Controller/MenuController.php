<?php

namespace App\Controller;

use App\Repository\OpeningTimeRepository;
use App\Repository\FormulaRepository;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu', name:'app_menu')]
    public function index(MenuRepository $menuRepository,FormulaRepository $formulaRepository,OpeningTimeRepository $openingTimeRepository, ): Response
    {
        return $this->render('menu/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'menuMethode'=>$menuRepository->findAll(),
            'formulaMethode'=>$formulaRepository->findAll()
        ]);
    }

}