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


class ReservationController extends AbstractController
{   

    #[Route('/reservation', name: 'app_reservation')]
    public function index(Request $request,ManagerRegistry $managerRegistry,OpeningTimeRepository $openingTimeRepository,ReservationRepository $reservationRepository,
    seatMaxRepository $seatMaxRepository,Security $security): Response
    {
        // Récupère le gestionnaire d'entité
        $entityManager = $managerRegistry->getManager();

        // Récupère le nombre de couverts maximum fixé en base de données dans la table PlacesMax
        $maxReservationPerDay = $seatMaxRepository->findOneBy(['id' => '1']); // Méthode pour récupérer l'unique ligne de la table.
        $maxReservationPerDayValue = $maxReservationPerDay->getNbrSeatMax();

        // Création d'une nouvelle instance de l'entité Reservations
        $reservation = new Reservation();
        $reservation->setTime(new \DateTime()); // Permet de mettre une date par défaut au formulaire de réservation
        $reservation->setHour(new \DateTime());// Permet de mettre une heure par défaut au formulaire de réservation
        
         // Récupère l'information enregistrée par défaut (Nombre de convives/allergies) par l'utilisateur connecté lors de son inscription
         if($this->isGranted('IS_AUTHENTICATED_FULLY') || $this->isGranted('ROLE_ADMIN')){
            $user = $security->getUser();
            $allergieUser = $user->getAllergie();
            $nameUser = $user->getLastname();
            $nbrCouvertUser = $user->getUserGuest();
            $reservation->setNbrGuest(intval($nbrCouvertUser)); // setNbrGuest demande un integer, mais si la valeur est null pour l'utilisateur alors cela déclenche une erreur, j'ai donc utilisé la methode intval()
            $reservation->setMealAllergy($allergieUser);
            $reservation->setName($nameUser);
         }

        // Création du formulaire et liaison avec l'entité correspondante
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

        // Recuperation du nombre de couverts à une date sélectionnée pour le service du midi
        $nbrCouvertMidi = $reservationRepository->countNbrCouvertDateMidi($reservationTime, $reservationHour );

        // Recuperation du nombre de couverts à une date sélectionnée pour le service du soir
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
        // Sinon affiche un message d'erreur.
        elseif ($maxReservationPerDayValue < ($nbrCouvertMidi + $nbrCouvertSelectionne) || $maxReservationPerDayValue < ($nbrCouvertSoir + $nbrCouvertSelectionne) ) {
            $this->addFlash('full', 'Il n\'y a plus de place disponible à cette date');
            return $this->redirectToRoute('app_reservation');
        }
        // On retourne le rendu twig auquel on passe les produits de la carte et le formulaire
        return $this->render('reservation/index.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'formResa' => $formResa->createView()
        ]);

    }
}
