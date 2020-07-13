<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200712123232 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE device DROP FOREIGN KEY FK_92FB68EC39426B9');
        $this->addSql('DROP INDEX IDX_92FB68EC39426B9 ON device');
        $this->addSql('ALTER TABLE device DROP attributs_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE device ADD attributs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE device ADD CONSTRAINT FK_92FB68EC39426B9 FOREIGN KEY (attributs_id) REFERENCES attribut (id)');
        $this->addSql('CREATE INDEX IDX_92FB68EC39426B9 ON device (attributs_id)');
    }
}
