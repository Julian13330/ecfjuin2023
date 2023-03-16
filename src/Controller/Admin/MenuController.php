<?php

namespace App\Controller\Admin;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use App\Repository\OpeningTimeRepository;
use App\Repository\FormulaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

#[Route('/admin/menus', name: 'admin_menus_')]
class MenuController extends AbstractController
{
  #[Route('/', name: 'index')]
  public function index(MenuRepository $menuRepository,OpeningTimeRepository $openingTimeRepository,FormulaRepository $formulaRepository): Response
  {
      return $this->render('admin/menus/index.html.twig', [
        'dayMethode' => $openingTimeRepository->findAll(),
        'menuMethode'=>$menuRepository->findAll(),
        'formulaMethode'=>$formulaRepository->findAll()
    ]);
  }

}
