<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200629094932 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attribut ADD unit VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE device ADD attributs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68EC39426B9 FOREIGN KEY (attributs_id) REFERENCES attribut (id)');
        $this->addSql('CREATE INDEX IDX_92FB68EC39426B9 ON device (attributs_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_957A6479ABE530DA ON fos_user (cin)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE event');
        $this->addSql('ALTER TABLE attribut DROP unit');
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68EC39426B9');
        $this->addSql('DROP INDEX IDX_92FB68EC39426B9 ON device');
        $this->addSql('ALTER TABLE device DROP attributs_id');
        $this->addSql('DROP INDEX UNIQ_957A6479ABE530DA ON fos_user');
    }
}
