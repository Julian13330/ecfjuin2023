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

#[Route('/admin/plats', name: 'admin_plats_')]
class MealController extends AbstractController
{
    #[Route('/', name: 'liste_')]
    public function index(MealRepository $mealRepository,OpeningTimeRepository $openingTimeRepository): Response
    {

        return $this->render('admin/plats/liste.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'mealMethode'=>$mealRepository->findAll(),
        ]);
    }

    #[Route('/gestion', name: 'gestion_')]
    public function gestion(MealRepository $mealRepository,OpeningTimeRepository $openingTimeRepository): Response
    {

        return $this->render('admin/plats/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'mealMethode'=>$mealRepository->findAll(),
        ]);
    }

    // Ajouter un nouveau plat
    #[Route('/ajout/{title}', name: 'add_')]
    public function ajout(MealRepository $mealRepository,Meal $meal,OpeningTimeRepository $openingTimeRepository, EntityManagerInterface $EntityManager,Request $request): Response
    {
        //On crée un nouveau plat
        $meal = new Meal();
    
        // On crée le formulaire
        $mealForm = $this->createForm(MealFormType::class, $meal);
    
        // On traite la requête du formulaire
        $mealForm->handleRequest($request);

        //On vérifie si le formulaire est soumis ET valide
        if ($mealForm->isSubmitted() && $mealForm->isValid()) {
            if(!$meal->getId()){
                $EntityManager->persist($meal);
            }

            $EntityManager->flush();
            $this->addFlash('success', 'Plat modifié avec succès');
            return $this->redirectToRoute('app_main');
    
           
    }
            return $this->render('admin/plats/ajout.html.twig', [
                'mealForm' => $mealForm->createView(),
                'dayMethode' => $openingTimeRepository->findAll(),
                'mealMethode' => $mealRepository->findAll()
            ]);
        }

    // Modifier un plat
  #[Route('/{id}', name: 'edit')]
    public function edit(MealRepository $mealRepository,Meal $meal,OpeningTimeRepository $openingTimeRepository, EntityManagerInterface $EntityManager,Request $request): Response
    {   
        
        if(!$meal){
            $meal = new Meal();
        }

    $mealForm =$this->createForm(MealFormType::class, $meal);

    $mealForm->handleRequest($request);
    if ($mealForm->isSubmitted() && $mealForm->isValid()) {
        if(!$meal->getId()){
            $EntityManager->persist($meal);
        }
        $EntityManager->flush();

        $this->addFlash('success', 'Plat modifié avec succès');
        return $this->redirectToRoute('app_main');
}
        return $this->render('admin/plats/edit.html.twig', [
            'mealForm' => $mealForm->createView(),
            'dayMethode' => $openingTimeRepository->findAll(),
            'mealMethode' => $mealRepository->findAll()
        ]);
    }

    // Supprimer un plat
    #[Route('suppression/{id}', name: 'delete')]
    public function delete(MealRepository $mealRepository,OpeningTimeRepository $openingTimeRepository,Meal $meal,EntityManagerInterface $EntityManager,Request $request): Response
    {
        $EntityManager->remove($meal);
        $EntityManager->flush();

        $this->addFlash('success', 'Plat supprimé avec succès');
        return $this->redirectToRoute('app_main');

        return $this->render('admin/plats/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'mealMethode' => $mealRepository->findAll()
        ]);
    }
}