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


#[Route('/admin', name:'admin_users_')]
class UsersController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(OpeningTimeRepository $openingTimeRepository): Response
    {
        return $this->render('admin/users/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll()
        ]);
    }

    #[Route('/horaire', name:'horaire')]
    public function horaire(Request $request,OpeningTimeRepository $openingTimeRepository, EntityManagerInterface $em): Response
    {  
        $openingTime = new OpeningTime();

        $horaireForm =$this->createForm(OpeningTimeFormType::class, $openingTime);

        $horaireForm->handleRequest($request);
        if ($horaireForm->isSubmitted() && $horaireForm->isValid()) {
            $openingTime = $horaireForm->getData();

            // On stocke
            $em->persist($openingTime);
            $em->flush();

            $this->addFlash('success', 'Horaire modifié avec succès');

        return $this->redirectToRoute('admin_horaire_index');
    }

    return $this->render('admin/horaire/index.html.twig',[
        'horaireForm' => $horaireForm->createView(),
        'dayMethode' => $openingTimeRepository->findAll()
    ]);
}
}