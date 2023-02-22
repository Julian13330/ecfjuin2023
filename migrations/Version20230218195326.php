<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218195326 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE calendar (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, start DATETIME NOT NULL, end DATETIME NOT NULL, description LONGTEXT NOT NULL, all_day TINYINT(1) NOT NULL, background_color VARCHAR(7) NOT NULL, border_color VARCHAR(7) NOT NULL, text_color VARCHAR(7) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parent_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, INDEX IDX_64C19C1727ACA70 (parent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formula (id INT AUTO_INCREMENT NOT NULL, menu_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_67315881CCD7E912 (menu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meal (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, category_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, image_name VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_9EF68E9C67B3B43D (users_id), INDEX IDX_9EF68E9C12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, INDEX IDX_7D053A9367B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opening_time (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, day VARCHAR(30) NOT NULL, hour_in DATETIME NOT NULL, hour_out DATETIME NOT NULL, open TINYINT(1) NOT NULL, INDEX IDX_89115E6E67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, users_id INT DEFAULT NULL, restaurant_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, time DATETIME NOT NULL, nbr_guest INT NOT NULL, hour TIME NOT NULL, meal_allergy VARCHAR(100) NOT NULL, INDEX IDX_42C8495567B3B43D (users_id), INDEX IDX_42C84955B1E7706E (restaurant_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE restaurant (id INT AUTO_INCREMENT NOT NULL, opening_time_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, INDEX IDX_EB95123F6A8073BB (opening_time_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seat_max (id INT AUTO_INCREMENT NOT NULL, nbr_seat_max INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, username VARCHAR(100) NOT NULL, lastname VARCHAR(100) NOT NULL, firstname VARCHAR(100) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', allergie VARCHAR(100) DEFAULT NULL, user_guest INT DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1727ACA70 FOREIGN KEY (parent_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE formula ADD CONSTRAINT FK_67315881CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE meal ADD CONSTRAINT FK_9EF68E9C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A9367B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE opening_time ADD CONSTRAINT FK_89115E6E67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495567B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id)');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F6A8073BB FOREIGN KEY (opening_time_id) REFERENCES opening_time (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1727ACA70');
        $this->addSql('ALTER TABLE formula DROP FOREIGN KEY FK_67315881CCD7E912');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C67B3B43D');
        $this->addSql('ALTER TABLE meal DROP FOREIGN KEY FK_9EF68E9C12469DE2');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A9367B3B43D');
        $this->addSql('ALTER TABLE opening_time DROP FOREIGN KEY FK_89115E6E67B3B43D');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495567B3B43D');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955B1E7706E');
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F6A8073BB');
        $this->addSql('DROP TABLE calendar');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE formula');
        $this->addSql('DROP TABLE meal');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE opening_time');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE restaurant');
        $this->addSql('DROP TABLE seat_max');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
