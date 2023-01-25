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
}