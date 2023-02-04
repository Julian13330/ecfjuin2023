<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Entity\Meal;
use App\Form\MealFormType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\OpeningTimeRepository;
use App\Service\PictureService;
use App\Repository\MealRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

#[Route('/admin', name: 'admin_plats_')]
class MealController extends AbstractController
{
    #[Route('/plats', name: 'index')]
    public function index(MealRepository $mealRepository,OpeningTimeRepository $openingTimeRepository): Response
    {

        return $this->render('admin/plats/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'mealMethode'=>$mealRepository->findAll(),
        ]);
    }

   
    #[Route('/plats/ajout', name: 'add')]
    //#[ParamConverter('id', options: ['mapping' => ['id' => 'meal']])]
    public function ajout(MealRepository $mealRepository,Meal $meal,OpeningTimeRepository $openingTimeRepository, EntityManagerInterface $EntityManager,Request $request, PictureService $pictureService): Response
    {
    // On crée un "nouveau plat"
    $meal = new Meal();

    // On crée le formulaire
    $mealForm =$this->createForm(MealFormType::class, $meal);

    // On traite la requête du formulaire
    $mealForm->handleRequest($request);

    // On vérifie si le formulaire est soumis ET valide
    if ($mealForm->isSubmitted() && $mealForm->isValid()) {
        // On récupère les photos
        $images = $mealForm->get('images')->getData();

        foreach($images as $image){

            // On définit le dossier de destination
            $folder = 'meal';

            // On appelle le service d'ajout
            $fichier = $pictureService->add($image, $folder, 300, 300);

            $img = new Image();
            $img->setTitle($fichier);
            $meal->addImage($img);

        }
        // On stocke
        $EntityManager->persist($meal);
        $EntityManager->flush();  

       $this->addFlash('success', 'Plat ajouté avec succès');
        // On redirige
        return $this->redirectToRoute('admin_plats_index ');
}
        return $this->render('admin/plats/ajout.html.twig', [
            'mealForm' => $mealForm->createView(),
            'dayMethode' => $openingTimeRepository->findAll(),
            'mealMethode' => $mealRepository->findAll()
        ]);
    }

  #[Route('/plats/{id}', name: 'edit')]
    public function edit(MealRepository $mealRepository,Meal $meal,OpeningTimeRepository $openingTimeRepository, EntityManagerInterface $EntityManager,Request $request): Response
    {
    $meal = new Meal();

    $mealForm =$this->createForm(MealFormType::class, $meal);

    $mealForm->handleRequest($request);
    if ($mealForm->isSubmitted() && $mealForm->isValid()) {
        if(!$meal->getId()){
            $EntityManager->persist($meal);
        }
        $EntityManager->flush();

        return $this->redirect($this->generateUrl('admin_plats_index ', ['id' =>$meal->getId()]));    

       $this->addFlash('success', 'Plat modifié avec succès');
}
        return $this->render('admin/plats/edit.html.twig', [
            'mealForm' => $mealForm->createView(),
            'dayMethode' => $openingTimeRepository->findAll(),
            'mealMethode' => $mealRepository->findAll()
        ]);
    }
}