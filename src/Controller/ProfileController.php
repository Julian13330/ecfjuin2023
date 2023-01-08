<?php

namespace App\Controller;

use App\Repository\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profil', name: 'profile_')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(OpeningTimeRepository $openingTimeRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'dayMethode'=> $openingTimeRepository->findAll(),
        ]);
    }

    #[Route('/reservation', name: 'orders')]
    public function orders(OpeningTimeRepository $openingTimeRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
        ]);
    }
}
