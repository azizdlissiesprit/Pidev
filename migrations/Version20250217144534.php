<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250217144534 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, created_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_9474526C4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, idowner_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, datecreation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FDCA8C9CD4E929F4 (idowner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, webinar_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, INDEX IDX_5E90F6D6A391D86E (webinar_id), INDEX IDX_5E90F6D6FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscriptioncours (id INT AUTO_INCREMENT NOT NULL, idcours_id INT NOT NULL, iduser_id INT NOT NULL, dateinscription DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_81598734D41A30BD (idcours_id), INDEX IDX_81598734786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, idcours_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, videourl VARCHAR(255) DEFAULT NULL, ordre INT NOT NULL, INDEX IDX_F87474F3D41A30BD (idcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, iduser_id INT DEFAULT NULL, message LONGTEXT NOT NULL, dateenvoi DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, INDEX IDX_BF5476CA786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progression (id INT AUTO_INCREMENT NOT NULL, idlesson_id INT NOT NULL, datefin DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, INDEX IDX_D5B25073B3E3A863 (idlesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, idquiz_id INT NOT NULL, textquestion LONGTEXT NOT NULL, typequestion VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E5A38831B (idquiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizlesson (id INT AUTO_INCREMENT NOT NULL, lesson_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_8E3FE1EFCDF80196 (lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, idquestion_id INT NOT NULL, textreponse LONGTEXT NOT NULL, is_correct TINYINT(1) NOT NULL, INDEX IDX_5FB6DEC7D8E68610 (idquestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponsequiz (id_rep INT AUTO_INCREMENT NOT NULL, id_utilisateur INT DEFAULT NULL, id_question INT NOT NULL, reponse_choisie INT NOT NULL, est_correcte TINYINT(1) NOT NULL, date_reponse DATETIME NOT NULL, points INT NOT NULL, INDEX IDX_81D4714C50EAE44 (id_utilisateur), PRIMARY KEY(id_rep)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reviews (id INT AUTO_INCREMENT NOT NULL, idcours_id INT DEFAULT NULL, rating INT NOT NULL, review VARCHAR(255) NOT NULL, datecreation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6970EB0FD41A30BD (idcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, UNIQUE INDEX UNIQ_389B7835E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, datenaissance DATE DEFAULT NULL, passcode VARCHAR(255) DEFAULT NULL, datecreation DATETIME DEFAULT NULL, role VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webinar (id INT AUTO_INCREMENT NOT NULL, presenter_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, debut DATETIME NOT NULL, duration INT NOT NULL, category VARCHAR(255) NOT NULL, tags VARCHAR(255) NOT NULL, registration_required TINYINT(1) NOT NULL, max_attendees INT NOT NULL, platform VARCHAR(255) NOT NULL, lien VARCHAR(255) NOT NULL, recording_avaible TINYINT(1) NOT NULL, createdat DATETIME NOT NULL, updatedat DATETIME NOT NULL, INDEX IDX_C9E29F4ADDE4C635 (presenter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webinar_chat (id INT AUTO_INCREMENT NOT NULL, webinar_id INT DEFAULT NULL, user_id INT DEFAULT NULL, message VARCHAR(255) NOT NULL, send_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7F865B62A391D86E (webinar_id), INDEX IDX_7F865B62A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webinar_feedback (id INT AUTO_INCREMENT NOT NULL, webinar_id INT DEFAULT NULL, user_id INT DEFAULT NULL, rating INT NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_E32DD6BEA391D86E (webinar_id), INDEX IDX_E32DD6BEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE webinar_resources (id INT AUTO_INCREMENT NOT NULL, webinar_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, INDEX IDX_A63EA871A391D86E (webinar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CD4E929F4 FOREIGN KEY (idowner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6A391D86E FOREIGN KEY (webinar_id) REFERENCES webinar (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscriptioncours ADD CONSTRAINT FK_81598734D41A30BD FOREIGN KEY (idcours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE inscriptioncours ADD CONSTRAINT FK_81598734786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3D41A30BD FOREIGN KEY (idcours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B25073B3E3A863 FOREIGN KEY (idlesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E5A38831B FOREIGN KEY (idquiz_id) REFERENCES quizlesson (id)');
        $this->addSql('ALTER TABLE quizlesson ADD CONSTRAINT FK_8E3FE1EFCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7D8E68610 FOREIGN KEY (idquestion_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE reponsequiz ADD CONSTRAINT FK_81D4714C50EAE44 FOREIGN KEY (id_utilisateur) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0FD41A30BD FOREIGN KEY (idcours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE webinar ADD CONSTRAINT FK_C9E29F4ADDE4C635 FOREIGN KEY (presenter_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE webinar_chat ADD CONSTRAINT FK_7F865B62A391D86E FOREIGN KEY (webinar_id) REFERENCES webinar (id)');
        $this->addSql('ALTER TABLE webinar_chat ADD CONSTRAINT FK_7F865B62A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE webinar_feedback ADD CONSTRAINT FK_E32DD6BEA391D86E FOREIGN KEY (webinar_id) REFERENCES webinar (id)');
        $this->addSql('ALTER TABLE webinar_feedback ADD CONSTRAINT FK_E32DD6BEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE webinar_resources ADD CONSTRAINT FK_A63EA871A391D86E FOREIGN KEY (webinar_id) REFERENCES webinar (id)');
        $this->addSql('ALTER TABLE badges ADD CONSTRAINT FK_78F6539AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF04B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_tag ADD CONSTRAINT FK_5ACE3AF0BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionquiz ADD CONSTRAINT FK_D96D02102F32E690 FOREIGN KEY (id_quiz) REFERENCES quiz (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF04B89032C');
        $this->addSql('ALTER TABLE post_tag DROP FOREIGN KEY FK_5ACE3AF0BAD26311');
        $this->addSql('ALTER TABLE badges DROP FOREIGN KEY FK_78F6539AA76ED395');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C4B89032C');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CD4E929F4');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6A391D86E');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6FB88E14F');
        $this->addSql('ALTER TABLE inscriptioncours DROP FOREIGN KEY FK_81598734D41A30BD');
        $this->addSql('ALTER TABLE inscriptioncours DROP FOREIGN KEY FK_81598734786A81FB');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3D41A30BD');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA786A81FB');
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B25073B3E3A863');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E5A38831B');
        $this->addSql('ALTER TABLE quizlesson DROP FOREIGN KEY FK_8E3FE1EFCDF80196');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7D8E68610');
        $this->addSql('ALTER TABLE reponsequiz DROP FOREIGN KEY FK_81D4714C50EAE44');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0FD41A30BD');
        $this->addSql('ALTER TABLE webinar DROP FOREIGN KEY FK_C9E29F4ADDE4C635');
        $this->addSql('ALTER TABLE webinar_chat DROP FOREIGN KEY FK_7F865B62A391D86E');
        $this->addSql('ALTER TABLE webinar_chat DROP FOREIGN KEY FK_7F865B62A76ED395');
        $this->addSql('ALTER TABLE webinar_feedback DROP FOREIGN KEY FK_E32DD6BEA391D86E');
        $this->addSql('ALTER TABLE webinar_feedback DROP FOREIGN KEY FK_E32DD6BEA76ED395');
        $this->addSql('ALTER TABLE webinar_resources DROP FOREIGN KEY FK_A63EA871A391D86E');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE inscriptioncours');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE progression');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quizlesson');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE reponsequiz');
        $this->addSql('DROP TABLE reviews');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE webinar');
        $this->addSql('DROP TABLE webinar_chat');
        $this->addSql('DROP TABLE webinar_feedback');
        $this->addSql('DROP TABLE webinar_resources');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('ALTER TABLE questionquiz DROP FOREIGN KEY FK_D96D02102F32E690');
    }
}
