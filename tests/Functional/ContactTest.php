<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ContactTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/inscription');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Formulaire de contact');

        // Récupérer le formulaire
        $submitButton = $crawler->selectButton('Soumettre ma demande');
        $form = $submitButton->form();

        $form["registration_form_username"] = "007";
        $form["registration_form_lastname"] = "Bond";
        $form["registration_form_firstname"] = "James";
        $form["registration_form[email]"] = "jamedu13@test.com";
        $form["registration_form[userguest]"] = 2;

        // Soumettre le formulaire
        $client->submit($form);

        // Vérifier le stat HTTP
        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        // Vérifier l'envoie du mail

        // Vérifier la présence du message de succès.
        $this->assertSelectorTextContains(
            'div.alert.alert-success.mt-4',
            'Inscription effectuée avec succès '
        );
    }
}
