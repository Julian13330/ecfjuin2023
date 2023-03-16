<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use App\Repository\OpeningTimeRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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

  // Supprimer un utilisateur
  #[Route('suppression/{id}', name: 'delete')]
  public function delete(UsersRepository $usersRepository,Users $users,OpeningTimeRepository $openingTimeRepository,EntityManagerInterface $EntityManager,Request $request): Response
  {
      $EntityManager->remove($users);
      $EntityManager->flush();

      $this->addFlash('success', 'Utilisateur supprimé');
      return $this->redirectToRoute('app_main');

      return $this->render('admin/utilisateurs/index.html.twig', [
          'dayMethode' => $openingTimeRepository->findAll(),
          'users' => $usersRepository->findAll()
      ]);
  }
}