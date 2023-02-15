<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230212185600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE allergy_users DROP FOREIGN KEY FK_CEBB90C4DBFD579D');
        $this->addSql('ALTER TABLE allergy_users DROP FOREIGN KEY FK_CEBB90C467B3B43D');
        $this->addSql('DROP TABLE allergy');
        $this->addSql('DROP TABLE allergy_users');
        $this->addSql('ALTER TABLE users ADD allergie VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE allergy (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE allergy_users (allergy_id INT NOT NULL, users_id INT NOT NULL, INDEX IDX_CEBB90C467B3B43D (users_id), INDEX IDX_CEBB90C4DBFD579D (allergy_id), PRIMARY KEY(allergy_id, users_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE allergy_users ADD CONSTRAINT FK_CEBB90C4DBFD579D FOREIGN KEY (allergy_id) REFERENCES allergy (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE allergy_users ADD CONSTRAINT FK_CEBB90C467B3B43D FOREIGN KEY (users_id) REFERENCES users (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users DROP allergie');
    }
}
