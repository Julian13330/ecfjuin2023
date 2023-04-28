<?php

namespace App\Controller\Admin;

use App\Form\SeatMaxFormType;
use App\Entity\SeatMax;
use App\Entity\Restaurant;
use App\Repository\RestaurantRepository;
use App\Repository\SeatMaxRepository;
use App\Repository\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/admin/seat', name: 'admin_seat_')]
class SeatController extends AbstractController
{
  #[Route('/', name:'index')]
  public function index(OpeningTimeRepository $openingTimeRepository,SeatMaxRepository $seatMaxRepository,RestaurantRepository $restaurantRepository): Response
  {
    return $this->render('admin/seat/index.html.twig', [
      'dayMethode' => $openingTimeRepository->findAll(),
      'seatMethode' => $seatMaxRepository->findAll(),
      'restauMethode' => $restaurantRepository->findAll()

    ]);
  }

  #[Route('/place/{id}', name:'edit')]
    public function horaire(SeatMax $seatMax,Request $request,SeatMaxRepository $seatMaxRepository,OpeningTimeRepository $openingTimeRepository, EntityManagerInterface $EntityManager): Response
    {  
        if(!$seatMax){
            $seatMax = new SeatMax();
        }

        $seatForm =$this->createForm(SeatMaxFormType::class, $seatMax);

        $seatForm->handleRequest($request);
        if ($seatForm->isSubmitted() && $seatForm->isValid()) {
            if(!$seatMax->getId()){
                $EntityManager->persist($seatMax);
            }
            $EntityManager->flush();
            $this->addFlash('success', 'Le nombre de places a changé');
            return $this->redirectToRoute('app_main');
    }

    return $this->render('admin/seat/edit.html.twig',[
        'seatForm' => $seatForm->createView(),
        'dayMethode' => $openingTimeRepository->findAll()
    ]);
}
}