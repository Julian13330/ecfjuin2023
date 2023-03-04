<?php

namespace App\Controller\Admin;

use App\Entity\OpeningTime;
use App\Form\OpeningTimeFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/admin/horaires', name: 'admin_horaires_')]
class HorairesController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(OpeningTimeRepository $openingTimeRepository): Response
    {
        return $this->render('admin/jours/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll()
        ]);
    }

    #[Route('/jours/{day}', name:'edit')]
    public function horaire(OpeningTime $openingTime,Request $request,OpeningTimeRepository $openingTimeRepository, EntityManagerInterface $EntityManager): Response
    {  
        if(!$openingTime){
            $openingTime = new OpeningTime();
        }

        $horaireForm =$this->createForm(OpeningTimeFormType::class, $openingTime);

        $horaireForm->handleRequest($request);
        if ($horaireForm->isSubmitted() && $horaireForm->isValid()) {
            if(!$openingTime->getId()){
                $EntityManager->persist($openingTime);
            }
            $EntityManager->flush();
            $this->addFlash('success', 'Horaire modifié avec succès');
            return $this->redirectToRoute('app_main');
    }

    return $this->render('admin/horaires/index.html.twig',[
        'horaireForm' => $horaireForm->createView(),
        'dayMethode' => $openingTimeRepository->findAll()
    ]);
}
  
}