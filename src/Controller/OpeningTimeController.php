<?php

namespace App\Controller;

use App\Entity\OpeningTime;
use App\Repository\OpeningTimeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 class OpeningTimeController extends AbstractController
{
    #[Route('/horaire', name:'horaire')]
    public function list(OpeningTime $openingtime): Response
    {

  
    }

       
        //dump($openingTimeRepository->findAll());
        //dump($openingTimeRepository->findBy([
          //  'day' => 'lundi',
        //]));
        //dump($openingTimeRepository->findByDay('lundi'));   
        //$OpeningTime = $openingTimeRepository->find(id:25);
        //dump($OpeningTime->getDay('lundi'));
        //$OpeningTime = $openingTimeRepository->find(id:25);
        //dump($OpeningTime->getDay(''));
       // $OpeningTime = $openingTimeRepository->find(id:25); 
        //dump($OpeningTime->getDay(''));
        //return new Response(content:'<body></body>');
        //return $this->render('_partials/_footer.html.twig', compact('OpeningTime','openingTimeRepository'));
}