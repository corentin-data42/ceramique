<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250307105840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matiere_premiere (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, formule VARCHAR(255) DEFAULT NULL, pm_avant_cuisson DOUBLE PRECISION DEFAULT NULL, ordre INT DEFAULT NULL, active TINYINT(1) NOT NULL, creation_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', modification_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tl_matiere_premiere_oxyde (id INT AUTO_INCREMENT NOT NULL, matiere_premiere_id INT NOT NULL, oxyde_id INT NOT NULL, quantite DOUBLE PRECISION NOT NULL, INDEX IDX_3AB4F61E5B42BE3C (matiere_premiere_id), INDEX IDX_3AB4F61E660965A5 (oxyde_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tl_matiere_premiere_oxyde ADD CONSTRAINT FK_3AB4F61E5B42BE3C FOREIGN KEY (matiere_premiere_id) REFERENCES matiere_premiere (id)');
        $this->addSql('ALTER TABLE tl_matiere_premiere_oxyde ADD CONSTRAINT FK_3AB4F61E660965A5 FOREIGN KEY (oxyde_id) REFERENCES oxyde (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tl_matiere_premiere_oxyde DROP FOREIGN KEY FK_3AB4F61E5B42BE3C');
        $this->addSql('ALTER TABLE tl_matiere_premiere_oxyde DROP FOREIGN KEY FK_3AB4F61E660965A5');
        $this->addSql('DROP TABLE matiere_premiere');
        $this->addSql('DROP TABLE tl_matiere_premiere_oxyde');
    }
}
