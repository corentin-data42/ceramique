<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250321100104 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, flag_etat TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matiere_premiere ADD fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matiere_premiere ADD CONSTRAINT FK_179505B7670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_179505B7670C757F ON matiere_premiere (fournisseur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere_premiere DROP FOREIGN KEY FK_179505B7670C757F');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP INDEX IDX_179505B7670C757F ON matiere_premiere');
        $this->addSql('ALTER TABLE matiere_premiere DROP fournisseur_id');
    }
}
