<?php

namespace App\Controller;

use App\Repository\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/main', name: 'main')]
    public function index(OpeningTimeRepository $openingTimeRepository): Response
    {
        //return $this->render('main/index.html.twig', [
            return $this->render('_partials/_footer.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll()
        ]);
    }
  
}
