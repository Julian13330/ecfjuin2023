# Déploiement de l'application Symfony " Le Quai Antique "en local
## Le projet :
Cette application sert d'évaluation à la formation Graduate Développeur.
Le projet a pour objectif de créer une application pour un restaurant avec des fonctionnalités adéquates (réservation / carte / horaires / menu ...) .

## 1 Les prérequis :

+ [PHP 8.1 ou une version ultérieure](https://www.php.net/downloads.php)
+ Web server comme [Xampp](https://www.apachefriends.org/fr/download.html) avec sa base de données PhpMyAdmin
+ [Composer](https://getcomposer.org/download/)
+ [Cli Symfony](https://symfony.com/download)
+ [Visual Studio] (https://code.visualstudio.com/) pour l'IDE

## 2 Cloner le projet via Github :
`git clone https://github.com/Julian13330/ecfjuin2023.git`

## 3 Installation de Symfony dans l'IDE avec Composer :
Se rendre dans le projet avec l'IDE.
`symfony check:requirements`
`composer require webapp`


## 4 Accès à la base de données :
Modifier dans le fichier .env `DATABASE_URL=mysql://utilisateur:mot_de_passe@127.0.0.1:3306/nom_de_la_base_de_données?serverVersion=10.4.25-MariaDB`

## 5 Créer la base de données dans PhpMyAdmin:
`php bin/console doctrine:database:create`

## 6 Création des tables :
`php bin/console make:migration`
`php bin/console doctrine:migrations:migrate`

## 7 Intégration des fixtures :
`symfony console doctrine:fixtures:load`

## 8 Démarrer le serveur web :
`symfony serve -d` ou `symfony server:start` pour pouvoir accéder à notre page Symfony sur http://127.0.0.1:8000/

# L'accès au mode administrateur :
La dataFixtures "Users" va créer un utilisateur qui a le rôle administrateur. Je vous laisse vous rendre sur cette dataFixtures pour découvrir l'email et le mot de passe.

Sinon, nous pouvons utiliser le terminal :
