<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240716164150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE projekt (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, goal VARCHAR(255) DEFAULT NULL, values JSON DEFAULT NULL)');
        $this->addSql('CREATE TABLE record (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, tables VARCHAR(255) DEFAULT NULL, year INTEGER DEFAULT NULL, value DOUBLE PRECISION DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE projekt');
        $this->addSql('DROP TABLE record');
    }
}
