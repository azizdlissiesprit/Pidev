<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250216162013 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, idowner_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, datecreation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FDCA8C9CD4E929F4 (idowner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscriptioncours (id INT AUTO_INCREMENT NOT NULL, idcours_id INT NOT NULL, iduser_id INT NOT NULL, dateinscription DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_81598734D41A30BD (idcours_id), INDEX IDX_81598734786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lesson (id INT AUTO_INCREMENT NOT NULL, idcours_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, videourl VARCHAR(255) DEFAULT NULL, ordre INT NOT NULL, INDEX IDX_F87474F3D41A30BD (idcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE notification (id INT AUTO_INCREMENT NOT NULL, iduser_id INT DEFAULT NULL, message LONGTEXT NOT NULL, dateenvoi DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, INDEX IDX_BF5476CA786A81FB (iduser_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE progression (id INT AUTO_INCREMENT NOT NULL, idlesson_id INT NOT NULL, datefin DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(255) NOT NULL, INDEX IDX_D5B25073B3E3A863 (idlesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, idquiz_id INT NOT NULL, textquestion LONGTEXT NOT NULL, typequestion VARCHAR(255) NOT NULL, INDEX IDX_B6F7494E5A38831B (idquiz_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quizlesson (id INT AUTO_INCREMENT NOT NULL, lesson_id INT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_8E3FE1EFCDF80196 (lesson_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, idquestion_id INT NOT NULL, textreponse LONGTEXT NOT NULL, is_correct TINYINT(1) NOT NULL, INDEX IDX_5FB6DEC7D8E68610 (idquestion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reviews (id INT AUTO_INCREMENT NOT NULL, idcours_id INT DEFAULT NULL, rating INT NOT NULL, review VARCHAR(255) NOT NULL, datecreation DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_6970EB0FD41A30BD (idcours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CD4E929F4 FOREIGN KEY (idowner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscriptioncours ADD CONSTRAINT FK_81598734D41A30BD FOREIGN KEY (idcours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE inscriptioncours ADD CONSTRAINT FK_81598734786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE lesson ADD CONSTRAINT FK_F87474F3D41A30BD FOREIGN KEY (idcours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE notification ADD CONSTRAINT FK_BF5476CA786A81FB FOREIGN KEY (iduser_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE progression ADD CONSTRAINT FK_D5B25073B3E3A863 FOREIGN KEY (idlesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E5A38831B FOREIGN KEY (idquiz_id) REFERENCES quizlesson (id)');
        $this->addSql('ALTER TABLE quizlesson ADD CONSTRAINT FK_8E3FE1EFCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7D8E68610 FOREIGN KEY (idquestion_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE reviews ADD CONSTRAINT FK_6970EB0FD41A30BD FOREIGN KEY (idcours_id) REFERENCES cours (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CD4E929F4');
        $this->addSql('ALTER TABLE inscriptioncours DROP FOREIGN KEY FK_81598734D41A30BD');
        $this->addSql('ALTER TABLE inscriptioncours DROP FOREIGN KEY FK_81598734786A81FB');
        $this->addSql('ALTER TABLE lesson DROP FOREIGN KEY FK_F87474F3D41A30BD');
        $this->addSql('ALTER TABLE notification DROP FOREIGN KEY FK_BF5476CA786A81FB');
        $this->addSql('ALTER TABLE progression DROP FOREIGN KEY FK_D5B25073B3E3A863');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E5A38831B');
        $this->addSql('ALTER TABLE quizlesson DROP FOREIGN KEY FK_8E3FE1EFCDF80196');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7D8E68610');
        $this->addSql('ALTER TABLE reviews DROP FOREIGN KEY FK_6970EB0FD41A30BD');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE inscriptioncours');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE notification');
        $this->addSql('DROP TABLE progression');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quizlesson');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE reviews');
    }
}
