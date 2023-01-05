<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/horaires', name: 'admin_horaire_')]
class HoraireController extends AbstractController
{
    #[Route('/', name:'index')]
    public function index(): Response 
    {
        return $this->render('admin/horaire/index.html.twig');
    }
}