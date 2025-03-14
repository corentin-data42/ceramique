<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250314154858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matiere_premiere CHANGE active flag_etat TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE oxyde CHANGE actif flag_etat TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE oxyde CHANGE flag_etat actif TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE matiere_premiere CHANGE flag_etat active TINYINT(1) NOT NULL');
    }
}
