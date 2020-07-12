<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200712124117 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribut ADD device_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE attribut ADD CONSTRAINT FK_7AB8E85D94A4C7D4 FOREIGN KEY (device_id) REFERENCES device (id)');
        $this->addSql('CREATE INDEX IDX_7AB8E85D94A4C7D4 ON attribut (device_id)');
        $this->addSql('ALTER TABLE device ADD path VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE attribut DROP FOREIGN KEY FK_7AB8E85D94A4C7D4');
        $this->addSql('DROP INDEX IDX_7AB8E85D94A4C7D4 ON attribut');
        $this->addSql('ALTER TABLE attribut DROP device_id');
        $this->addSql('ALTER TABLE device DROP path');
    }
}
