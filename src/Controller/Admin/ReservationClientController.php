<?php

namespace App\Controller\Admin;

use App\Repository\ReservationRepository;
use App\Repository\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationClientController extends AbstractController
{
    #[Route('/compte', name: 'app_compte')]
    public function index(OpeningTimeRepository $openingTimeRepository,ReservationRepository $reservationRepository): Response
    {
        return $this->render('admin/réservationClient/index.html.twig', [
            'controller_name' => 'CompteController',
            'reservationCompte' => $reservationRepository->findAll(),
            'dayMethode' => $openingTimeRepository->findAll()
        ]);
    }
}
