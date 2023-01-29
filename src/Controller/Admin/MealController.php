<?php

namespace App\Controller\Admin;

use App\Entity\Meal;
use App\Form\MealFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OpeningTimeRepository;
use App\Repository\MealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/admin', name: 'admin_plats_')]
class MealController extends AbstractController
{
    #[Route('/plats', name: 'index')]
    public function index(MealRepository $mealRepository,OpeningTimeRepository $openingTimeRepository): Response
    {
        return $this->render('admin/plats/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'mealMethode'=>$mealRepository->findAll()
        ]);
    }

  #[Route('/plats/{id}', name: 'edit')]
    public function plats(Meal $meal,OpeningTimeRepository $openingTimeRepository, EntityManagerInterface $EntityManager,Request $request): Response
    {
    $meal = new Meal();

    $mealForm =$this->createForm(MealFormType::class, $meal);

    $mealForm->handleRequest($request);
    if ($mealForm->isSubmitted() && $mealForm->isValid()) {
        if(!$meal->getId()){
            $EntityManager->persist($meal);
        }
        $EntityManager->flush();

        return $this->redirect($this->generateUrl('app_home', ['id' =>$meal->getId()]));    

       $this->addFlash('success', 'Plat modifié avec succès');
}
        return $this->render('admin/plats/edit.html.twig', [
            'mealForm' => $mealForm->createView(),
            'dayMethode' => $openingTimeRepository->findAll()
        ]);
    }
}