<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use App\Repository\OpeningTimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/admin/compte', name: 'app_compte_')]
class ReservationClientController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(OpeningTimeRepository $openingTimeRepository,ReservationRepository $reservationRepository): Response
    {
        return $this->render('admin/réservationClient/index.html.twig', [
            'controller_name' => 'CompteController',
            'reservationCompte' => $reservationRepository->findAll(),
            'dayMethode' => $openingTimeRepository->findAll()
        ]);
    }

    // Supprimer une réservation
  #[Route('suppression/{id}', name: 'delete')]
  public function delete(ReservationRepository $reservationRepository,Reservation $reservations,OpeningTimeRepository $openingTimeRepository,EntityManagerInterface $EntityManager,Request $request): Response
  {
      $EntityManager->remove($reservations);
      $EntityManager->flush();

      $this->addFlash('success', 'Réservation supprimée');
      return $this->redirectToRoute('app_main');

      return $this->render('admin/réservationClient/index.html.twig', [
          'dayMethode' => $openingTimeRepository->findAll(),
          'reservationCompte' => $reservationRepository->findAll()
      ]);
  }
}
