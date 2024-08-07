<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240726154456 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projekt ADD COLUMN "values" CLOB DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__projekt AS SELECT id, goal FROM projekt');
        $this->addSql('DROP TABLE projekt');
        $this->addSql('CREATE TABLE projekt (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, goal VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO projekt (id, goal) SELECT id, goal FROM __temp__projekt');
        $this->addSql('DROP TABLE __temp__projekt');
    }
}
