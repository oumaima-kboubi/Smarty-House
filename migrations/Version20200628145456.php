<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200628145456 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actuator (id INT AUTO_INCREMENT NOT NULL, phenomene_physique_utilise VARCHAR(100) NOT NULL, principe_mis_en_oeuvre VARCHAR(150) NOT NULL, type_energie_utilisee VARCHAR(150) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE attribut (id INT AUTO_INCREMENT NOT NULL, actuator_id INT DEFAULT NULL, sensor_id INT DEFAULT NULL, name VARCHAR(100) NOT NULL, type VARCHAR(255) NOT NULL, on_label VARCHAR(200) DEFAULT NULL, off_lable VARCHAR(200) DEFAULT NULL, min DOUBLE PRECISION DEFAULT NULL, max DOUBLE PRECISION DEFAULT NULL, INDEX IDX_7AB8E85D77D4D665 (actuator_id), INDEX IDX_7AB8E85DA247991F (sensor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE camera (id INT AUTO_INCREMENT NOT NULL, house_id_id INT NOT NULL, name VARCHAR(100) NOT NULL, desription VARCHAR(255) NOT NULL, source VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_3B1CEE05A4A739AF (house_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE device (id INT AUTO_INCREMENT NOT NULL, room_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, type VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, icon VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_92FB68E35F83FFC (room_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metric (id INT AUTO_INCREMENT NOT NULL, attribut_id INT NOT NULL, value VARCHAR(255) NOT NULL, date DATETIME NOT NULL, INDEX IDX_87D62EE351383AF3 (attribut_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, link VARCHAR(255) NOT NULL, path VARCHAR(200) NOT NULL, title VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preset (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE preset_attribut (id INT AUTO_INCREMENT NOT NULL, attribut_id INT DEFAULT NULL, preset_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_F6D632E151383AF3 (attribut_id), INDEX IDX_F6D632E180688E6F (preset_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, house_id_id INT NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_729F519BA4A739AF (house_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scenario (id INT AUTO_INCREMENT NOT NULL, value VARCHAR(255) NOT NULL, time TIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sensor (id INT AUTO_INCREMENT NOT NULL, apport_energitique VARCHAR(20) NOT NULL, seuil_declenchement DOUBLE PRECISION NOT NULL, type_detection VARCHAR(30) NOT NULL, type_sortie VARCHAR(30) NOT NULL, created_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE smart_house (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attribut ADD CONSTRAINT FK_7AB8E85D77D4D665 FOREIGN KEY (actuator_id) REFERENCES actuator (id)');
        $this->addSql('ALTER TABLE attribut ADD CONSTRAINT FK_7AB8E85DA247991F FOREIGN KEY (sensor_id) REFERENCES sensor (id)');
        $this->addSql('ALTER TABLE camera ADD CONSTRAINT FK_3B1CEE05A4A739AF FOREIGN KEY (house_id_id) REFERENCES smart_house (id)');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68E35F83FFC FOREIGN KEY (room_id_id) REFERENCES room (id)');
        $this->addSql('ALTER TABLE metric ADD CONSTRAINT FK_87D62EE351383AF3 FOREIGN KEY (attribut_id) REFERENCES attribut (id)');
        $this->addSql('ALTER TABLE preset_attribut ADD CONSTRAINT FK_F6D632E151383AF3 FOREIGN KEY (attribut_id) REFERENCES attribut (id)');
        $this->addSql('ALTER TABLE preset_attribut ADD CONSTRAINT FK_F6D632E180688E6F FOREIGN KEY (preset_id) REFERENCES preset (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BA4A739AF FOREIGN KEY (house_id_id) REFERENCES smart_house (id)');
        $this->addSql('ALTER TABLE fos_user ADD house_id_id INT DEFAULT NULL, ADD country VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479A4A739AF FOREIGN KEY (house_id_id) REFERENCES smart_house (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479ABE530DA ON fos_user (cin)');

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribut DROP FOREIGN KEY FK_7AB8E85D77D4D665');
        $this->addSql('ALTER TABLE metric DROP FOREIGN KEY FK_87D62EE351383AF3');
        $this->addSql('ALTER TABLE preset_attribut DROP FOREIGN KEY FK_F6D632E151383AF3');
        $this->addSql('ALTER TABLE preset_attribut DROP FOREIGN KEY FK_F6D632E180688E6F');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68E35F83FFC');
        $this->addSql('ALTER TABLE attribut DROP FOREIGN KEY FK_7AB8E85DA247991F');
        $this->addSql('ALTER TABLE camera DROP FOREIGN KEY FK_3B1CEE05A4A739AF');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479A4A739AF');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BA4A739AF');
        $this->addSql('DROP TABLE actuator');
        $this->addSql('DROP TABLE attribut');
        $this->addSql('DROP TABLE camera');
        $this->addSql('DROP TABLE device');
        $this->addSql('DROP TABLE history');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE metric');
        $this->addSql('DROP TABLE news');
        $this->addSql('DROP TABLE preset');
        $this->addSql('DROP TABLE preset_attribut');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE scenario');
        $this->addSql('DROP TABLE sensor');
        $this->addSql('DROP TABLE smart_house');
        $this->addSql('DROP INDEX UNIQ_957A6479ABE530DA ON fos_user');
        $this->addSql('DROP INDEX IDX_957A6479A4A739AF ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP house_id_id, DROP country');
    }
}
