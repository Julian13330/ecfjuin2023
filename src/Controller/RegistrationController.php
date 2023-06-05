<?php

namespace App\Controller;

use App\Repository\OpeningTimeRepository;
use App\Entity\Users;
use App\Form\RegistrationFormType;
use App\Repository\UsersRepository;
use App\Security\UserAuthenticator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Mailer\MailerInterface;


class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request,UsersRepository $user,MailerInterface $mailer,UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, UserAuthenticator $authenticator, EntityManagerInterface $entityManager,OpeningTimeRepository $openingTimeRepository ): Response
    {
        $user = new Users();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            //Email
            //$email = (new TemplatedEmail())
            //->from($user->getEmail())
            //->to('admin@restauranttest.com')
            //->subject('Vous êtes bien inscrit')
            //->text('Sending emails is fun again!')
            //->htmlTemplate('emails/contact.html.twig')

            // pass variables (name => value) to the template
            //->context([
              //  'users' => $user
            //]);

            //$mailer->send($email);

            $this->addFlash('success', 'Inscription effectuée avec succès');
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'dayMethode' => $openingTimeRepository->findAll(),
            'registrationForm' => $form->createView(),
        ]);
    }
}
