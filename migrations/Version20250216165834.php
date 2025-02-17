<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250216165834 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reponsequiz (id_rep INT AUTO_INCREMENT NOT NULL, id_utilisateur INT DEFAULT NULL, id_question INT NOT NULL, reponse_choisie INT NOT NULL, est_correcte TINYINT(1) NOT NULL, date_reponse DATETIME NOT NULL, points INT NOT NULL, INDEX IDX_81D4714C50EAE44 (id_utilisateur), PRIMARY KEY(id_rep)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webinar_chat (id INT AUTO_INCREMENT NOT NULL, webinar_id INT DEFAULT NULL, user_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, send_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7F865B62A391D86E (webinar_id), INDEX IDX_7F865B62A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webinar_feedback (id INT AUTO_INCREMENT NOT NULL, webinar_id INT DEFAULT NULL, user_id INT DEFAULT NULL, rating INT NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_E32DD6BEA391D86E (webinar_id), INDEX IDX_E32DD6BEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webinar_resources (id INT AUTO_INCREMENT NOT NULL, webinar_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_A63EA871A391D86E (webinar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reponsequiz ADD CONSTRAINT FK_81D4714C50EAE44 FOREIGN KEY (id_utilisateur) REFERENCES user (id)');
        $this->addSql('ALTER TABLE webinar_chat ADD CONSTRAINT FK_7F865B62A391D86E FOREIGN KEY (webinar_id) REFERENCES webinar (id)');
        $this->addSql('ALTER TABLE webinar_chat ADD CONSTRAINT FK_7F865B62A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE webinar_feedback ADD CONSTRAINT FK_E32DD6BEA391D86E FOREIGN KEY (webinar_id) REFERENCES webinar (id)');
        $this->addSql('ALTER TABLE webinar_feedback ADD CONSTRAINT FK_E32DD6BEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE webinar_resources ADD CONSTRAINT FK_A63EA871A391D86E FOREIGN KEY (webinar_id) REFERENCES webinar (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reponsequiz DROP FOREIGN KEY FK_81D4714C50EAE44');
        $this->addSql('ALTER TABLE webinar_chat DROP FOREIGN KEY FK_7F865B62A391D86E');
        $this->addSql('ALTER TABLE webinar_chat DROP FOREIGN KEY FK_7F865B62A76ED395');
        $this->addSql('ALTER TABLE webinar_feedback DROP FOREIGN KEY FK_E32DD6BEA391D86E');
        $this->addSql('ALTER TABLE webinar_feedback DROP FOREIGN KEY FK_E32DD6BEA76ED395');
        $this->addSql('ALTER TABLE webinar_resources DROP FOREIGN KEY FK_A63EA871A391D86E');
        $this->addSql('DROP TABLE reponsequiz');
        $this->addSql('DROP TABLE webinar_chat');
        $this->addSql('DROP TABLE webinar_feedback');
        $this->addSql('DROP TABLE webinar_resources');
    }
}
