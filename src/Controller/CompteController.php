<?php

namespace App\Controller;

use App\Entity\Users;
use App\Repository\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

#[Route('/moncompte', name:'app_moncompte_')]
class CompteController extends AbstractController
{
  #[Route('/', name: 'index')]
  public function index(OpeningTimeRepository $openingTimeRepository,Security $security,Request $request ): Response
  {
    return $this->render('compte/index.html.twig', [
      'dayMethode' => $openingTimeRepository->findAll(),
  ]);
  }
}