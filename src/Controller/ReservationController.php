<?php

namespace App\Controller;

use App\Form\ReservationFormType;
use App\Entity\Reservation;
use App\Repository\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request,OpeningTimeRepository $openingTimeRepository,EntityManagerInterface $em): Response
    {
        $reservation = new Reservation();
        $reservationForm = $this->createForm(ReservationFormType::class, $reservation);
        $reservationForm->handleRequest($request);

        $reservationForm->handleRequest($request);
        if ($reservationForm ->isSubmitted() && $reservationForm ->isValid()) {
            $openingTime = $reservationForm->getData();

            // On stocke
            $em->persist($openingTime);
            $em->flush();

            $this->addFlash('success', 'Réservation effectuée avec succès');

        return $this->redirectToRoute('');
    }
        return $this->render('reservation/index.html.twig', [
            'reservationForm' => $reservationForm->createView(),
            'dayMethode' => $openingTimeRepository->findAll()
        ]);
    }
}
