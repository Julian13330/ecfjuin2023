<?php

namespace App\Controller\Admin;


use App\Repository\OpeningTimeRepository;
use App\Repository\UsersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/utilisateurs', name: 'admin_utilisateurs_')]
class UserController extends AbstractController
{
  #[Route('/', name:'index')]
  public function index(OpeningTimeRepository $openingTimeRepository,UsersRepository $usersRepository): Response
  {
    return $this->render('admin/utilisateurs/index.html.twig', [
      'users' => $usersRepository->findAll(),
      'dayMethode' => $openingTimeRepository->findAll()
    ]);
  }
}