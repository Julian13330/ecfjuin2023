<?php

namespace App\Controller\Admin;


use App\Repository\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin', name: 'admin_')]
class MainController extends AbstractController
{
  #[Route('/', name:'index')]
  public function index(OpeningTimeRepository $openingTimeRepository): Response
  {
    return $this->render('admin/index.html.twig', [
      'dayMethode' => $openingTimeRepository->findAll()
    ]);
  }
}