-- CREATION DE LA BASE DE DONNEES restau --

CREATE DATABASE IF NOT EXISTS restau;

----------------------------------------------------------------------------------------------------

-- CREATION DES TABLES DANS LA BASE DE DONNEES -- 

-- Création de la table users --

CREATE TABLE users (
  id_users INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
  username VARCHAR (100),
  email VARCHAR (180),
  password VARCHAR (75),
  firstname VARCHAR (100),
  lastname VARCHAR (100),
  role VARCHAR (30),
  created_at DATETIME,
  allergie VARCHAR (30),
  user_guest int
) engine=INNODB;

-- Création de la table opening_time --

CREATE TABLE opening_time (
  id_opening_time INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
  day VARCHAR (30),
  open_soon DATETIME,
  close_soon DATETIME,
  open_night DATETIME,
  close_night DATETIME,
  open BOOLEAN,
  id_users INT NULL,
  FOREIGN KEY (id_users) REFERENCES users(id_users)
) engine=INNODB;

-- Création de la table restaurant --

CREATE TABLE restaurant (
  id_restaurant INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
  name VARCHAR (100),
  id_opening_time INT NULL,
  FOREIGN KEY (id_opening_time) REFERENCES opening_time(id_opening_time)
) engine=INNODB;

-- Création de la table reservation --

CREATE TABLE reservation (
  id_reservation INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
  name VARCHAR (100),
  date DATETIME,
  hour DATETIME,
  nbre_guest INT,
  meal_allergy VARCHAR (100),
  id_restaurant INT NULL,
  id_users INT NULL,
  FOREIGN KEY (id_restaurant) REFERENCES restaurant(id_restaurant),
  FOREIGN KEY (id_users) REFERENCES users(id_users)
) engine=INNODB;

-- Création de la table seat_max --

CREATE TABLE seat_max (
  id_seat_max INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
  nbr_seat_max INT,
  id_reservation INT NULL,
  FOREIGN KEY (id_reservation) REFERENCES reservation(id_reservation)
) engine=INNODB;

-- Création de la table menu --

CREATE TABLE menu (
  id_menu INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
  title VARCHAR (100),
  id_users INT NULL,
  FOREIGN KEY (id_users) REFERENCES users(id_users)
) engine=INNODB;

-- Création de la table formula --

CREATE TABLE formula (
  id_formula INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
  description VARCHAR (100),
  price INT,
  id_menu INT NULL,
  FOREIGN KEY (id_menu) REFERENCES menu(id_menu)
) engine=INNODB;

-- Création de la table category --

CREATE TABLE category (
  id_category INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
  title VARCHAR (100),
  id_menu INT NULL,
  FOREIGN KEY (id_menu) REFERENCES menu(id_menu)
) engine=INNODB;

-- Création de la table meal --

CREATE TABLE meal (
  id_meal INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
  title VARCHAR (100),
  description VARCHAR (255),
  price INT,
  image_name VARCHAR (255),
  favoris BOOLEAN,
  id_category INT NULL,
  id_users INT NULL,
  FOREIGN KEY (id_category) REFERENCES category(id_category),
  FOREIGN KEY (id_users) REFERENCES users(id_users)
) engine=INNODB;


-- FIN DE LA CREATION DES TABLES --

-- 


----------------------------------------------------------------------------------------------------

-- ALIMENTATION DES DONNEES DANS LES TABLES --

-- Alimentation de la table user --

INSERT INTO users (id_users,username,email,password,firstname,lastname,role,created_at,allergie,user_guest)
VALUES
(1,'Maisie','mdemkowicz0@twitpic.com','$2y$10$AQXldLbuI1/USj8IFYQg8OpH8Y7p0procnP8G6x0H1ftA8Xe5UiU2','Mickael','Papadopoulos','customer','2022-10-12 09:10:00','crustacé',6),
(2,'Glenden','gsimonitto2@dailymotion.com','$2y$10$KITCknBJwucshLzX8hfVXeCiv4xjZdJFCr8ZXEbF0yH0JCFV4Nu8a','Simonetto','machadis','customer','2022-11-09 08:00:00','glâce',14),
(3,'Agneta','atocknell3@a8.net','$2y$10$KITCknBJwucshLzX8hfVXeCiv4xjZdJFCr8ZXEbF0yH0JCKHDHb','Grossoadmin','gabiadmin','admin','2022-10-08 12:45:00','olive',2)

-- Alimentation de la table seat_max --
INSERT INTO seat_max (id_seat_max,nbr_seat_max)
VALUES
(1,20)

-- Alimentation de la table restaurant --
INSERT INTO restaurant (id_restaurant,name)
VALUES
(1,'Le Quai Antique')

-- Alimentation de la table restaurant --
INSERT INTO reservation (id_reservation,name,date,hour,nbre_guest,meal_allergy)
VALUES
(1,'Voldemort','2023-10-04 00:00:00','2023-10-04 12:00:00',4,'poisson')

-- Alimentation de la table restaurant --
INSERT INTO reservation (id_reservation,name,date,hour,nbre_guest,meal_allergy)
VALUES
(1,'Voldemort','2023-10-04 00:00:00','2023-10-04 12:00:00',4,'poisson')

-- Alimentation de la table opening_time --
INSERT INTO opening_time (id_opening_time,day,open_soon,close_soon,open_night,close_night,open)
VALUES
(1,'lundi','2023:03:10 12:00:00','2023:03:10 14:00:00','2023:03:10 19:00:00','2023:03:10 23:00:00',0),
(2,'mardi','2023:03:10 12:00:00','2023:03:10 14:00:00','2023:03:10 19:00:00','2023:03:10 23:00:00',1),
(3,'mercredi','2023:03:10 12:00:00','2023:03:10 14:00:00','2023:03:10 19:00:00','2023:03:10 23:00:00',1),
(4,'jeudi','2023:03:10 12:00:00','2023:03:10 14:00:00','2023:03:10 19:00:00','2023:03:10 23:00:00',1),
(5,'vendredi','2023:03:10 12:00:00','2023:03:10 14:00:00','2023:03:10 19:00:00','2023:03:10 23:00:00',1),
(6,'samedi','2023:03:10 12:00:00','2023:03:10 14:00:00','2023:03:10 19:00:00','2023:03:10 23:00:00',1),
(7,'dimanche','2023:03:10','2023:03:10 14:00:00','2023:03:10 19:00:00','2023:03:10 23:00:00',1)


-- Alimentation de la table menu --
INSERT INTO menu (id_menu,title)
VALUES
(1,'Menu Moussaillon -10 ans'),
(2,'Menu Plaisir')


-- Alimentation de la table category --
INSERT INTO category (id_category,title)
VALUES
(1,'Les entrées'),
(2,'Les plats mer'),
(3,'Les plats terre'),
(4,'Les desserts')

-- Alimentation de la table meal --
INSERT INTO meal (id_meal,id_category,title,description,image_name,price,favoris)
VALUES
(1,1,'La soupe de poissons','Fait maison','soupe-de-poisson-63f23c6301355069455382.jpg',14,1),
(2,2,'La dorade','Fait maison','fish-g09a112b2e-640-64036e3919e20551056557.jpg',32,1),
(3,3,'Entrecôte grillée','Fait maison','entrecote.jpg',26,1),
(4,4,'Mousse au chocolat','Fait maison','nougat-gb7b4b5723-640-64036e8b71185672639148.jpg',10,1)

-- Alimentation de la table formula --
INSERT INTO formula (id_formula,description,price,id_menu)
VALUES
(1,'Formule du petit moussaillon',10,1),
(2,'Formule du grand moussaillon',14,1),
(3,'Formule déjeuner',18,2),
(4,'Formule diner',24,2)


