<?php

namespace App\Controller;

use App\Form\ReservationFormType;
use App\Entity\Reservation;
use App\Entity\Users;
use App\Entity\SeatMax;
use App\Repository\ReservationRepository;
use App\Repository\OpeningTimeRepository;
use App\Repository\SeatMaxRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

//const HTTP_OK = 200;
//const HTTP_BAD_REQUEST = 400;
//const HTTP_METHOD_NOT_ALLOWED = 405;


class ReservationController extends AbstractController
{   

    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request,ManagerRegistry $managerRegistry,OpeningTimeRepository $openingTimeRepository,ReservationRepository $reservationRepository,
    seatMaxRepository $seatMaxRepository,Security $security): Response
    {
        $entityManager = $managerRegistry->getManager();

        // On va récupérer le nombre d'invités maximum via la table seat_max 
        $maxReservationPerDay = $seatMaxRepository->findOneBy(['NbrSeatMax' => '20']);
        $maxReservationPerDayValue = $maxReservationPerDay->getNbrSeatMax();

        // Création de la nouvelle instance Rerservation
        $reservation = new Reservation();
        $reservation->setTime(new \DateTime("z")); // Ajout de la date au formulaire
        $reservation->setHour(new \DateTime());// Ajout de la date au formulaire
        
         // Récupère les préférences de l'utilisateur qui est authentifié
        if($this->isGranted('IS_AUTHENTICATED_FULLY') || $this->isGranted('ROLE_ADMIN')){
            $user = $security->getUser();
            $allergieUser = $user->getAllergie();
            $nameUser = $user->getLastname();
            $nbrCouvertUser = $user->getUserGuest();
            // Utilisation de intval() car message d'erreur
            $reservation->setNbrGuest(intval($nbrCouvertUser));
            // Utilisation de intval() car message d'erreur
            $reservation->setMealAllergy($allergieUser);
            $reservation->setName($nameUser);
        }

        // Création du formulaire
        $formResa = $this->createForm(ReservationFormType::class, $reservation);

        // Recuperation des données du formulaire
        $formResa->handleRequest($request);
        $data = $formResa->getData();
        $reservationTime = $data->getTime();
        $reservationHour = $data->getHour();
        $nbrCouvertSelectionne = $data->getnbrGuest();

         // Formatage de la date et l'heure pour qu'elle puisse être passée au custom QueryBuilder countNbrCouvertForDate()
        $reservationTime = $reservationTime->format('Y-m-d');
        $reservationHour = $reservationHour->format('H:m:s');

        // Recuperation du nombre d'invités le midi
        $nbrCouvertMidi = $reservationRepository->countNbrCouvertDateMidi($reservationTime, $reservationHour );

        // Recuperation du nombre d'invités le soir
        $nbrCouvertSoir = $reservationRepository->countNbrCouvertDateSoir($reservationTime, $reservationHour);

        // Vérifie si formulaire valide, et si assez de place à la date et l'heure sélectionnée
        if ($formResa->isSubmitted()
            && $formResa->isValid()
            && $maxReservationPerDayValue >= ($nbrCouvertMidi + $nbrCouvertSelectionne)
            && $maxReservationPerDayValue >= ($nbrCouvertSoir + $nbrCouvertSelectionne))
        {
            // Recuperation de l'email du client
            //$mailUser = $this->getUserOrGuestIdentifier($security);
            //$reservation->setClientEmail($mailUser);

            // Enregistrement en base de données et affichage d'un message de confirmation
            $entityManager->persist($reservation);
            $entityManager->flush();
            $this->addFlash('success', 'Merci, votre réservation a bien été prise en compte');
            return $this->redirectToRoute('app_main');
        }
        // Sinon affiche un message d'erreur car il n'y a plus de places disponibles
        elseif ($maxReservationPerDayValue < ($nbrCouvertMidi + $nbrCouvertSelectionne) || $maxReservationPerDayValue < ($nbrCouvertSoir + $nbrCouvertSelectionne) ) {
            //$this->addFlash('full', 'Il n\'y a plus de place disponible à cette date');
            //return $this->redirectToRoute('app_reservation');
            echo "<script>alert(\"Il n'y a malheuresement plus de places pour ce créneau horaire, merci de choisir une autre heure\")</script>";
            //return $this->json(['code' => 200, 'message' => 'ca marche bien'], 200);
            // A afficher !$flash = 'Plus de places disponibles';
            //A afficher !header('Content-Type: application/json');
            //A afficher ! echo json_encode($flash);
            //return $this->json(['code' => 200, 'message' => $flash], 200);

            
           // if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtoupper($_SERVER['HTTP_X_REQUESTED_WITH']) == 'XMLHTTPREQUEST')
            //{
                //$response_code = HTTP_BAD_REQUEST;
                //$message = "Il manque le paramètre ACTION!";

                //if ($_POST['action'] == "showData" && isset($_POST['number']))
                //{
                    //$response_code = HTTP_OK;
                    //$number = $_POST['number'];
                    //$message = "<h5>Bon score ! </h5>";

                    //if ($number < 5){
                        //$message = "<h5>Mauvais score</h5>";
                    //}
                //}

                //response($response_code, $message, $number);
           // }
            //else
           // {
                //$response_code = HTTP_METHOD_NOT_ALLOWED;
                //$message = "Méthode not allowed!";
                
                //response($response_code, $message);
          //  }

           // function response($response_code, $response, $number = null)
           // {
               // header('Content-Type: application/json');
              //  http_response_code($response_code);

               // $response = [
                   // "response_code" => $response_code,
                   // "message" => $response,
                   // "number" => $number
              //  ];

               // echo json_encode($response);
           // }


        }
        // On retourne le rendu twig auquel on passe les produits de la carte et le formulaire
        return $this->render('reservation/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'formResa' => $formResa->createView()
        ]);

    }
}