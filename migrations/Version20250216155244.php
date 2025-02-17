<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250216155244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, webinar_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, INDEX IDX_5E90F6D6A391D86E (webinar_id), INDEX IDX_5E90F6D6FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webinar (id INT AUTO_INCREMENT NOT NULL, presenter_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, debut DATETIME NOT NULL, duration INT NOT NULL, category VARCHAR(255) NOT NULL, tags VARCHAR(255) NOT NULL, registration_required TINYINT(1) NOT NULL, max_attendees INT NOT NULL, platform VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, recording_avaible TINYINT(1) NOT NULL, createdat DATETIME NOT NULL, updatedat DATETIME NOT NULL, INDEX IDX_C9E29F4ADDE4C635 (presenter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A391D86E FOREIGN KEY (webinar_id) REFERENCES webinar (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE webinar ADD CONSTRAINT FK_C9E29F4ADDE4C635 FOREIGN KEY (presenter_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A391D86E');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6FB88E14F');
        $this->addSql('ALTER TABLE webinar DROP FOREIGN KEY FK_C9E29F4ADDE4C635');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE webinar');
    }
}
