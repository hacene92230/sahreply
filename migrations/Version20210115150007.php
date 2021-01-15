<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115150007 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE instruction (id INT AUTO_INCREMENT NOT NULL, contenu VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestation ADD instruction_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FAD62A10F76 FOREIGN KEY (instruction_id) REFERENCES instruction (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_51C88FAD62A10F76 ON prestation (instruction_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FAD62A10F76');
        $this->addSql('DROP TABLE instruction');
        $this->addSql('DROP INDEX UNIQ_51C88FAD62A10F76 ON prestation');
        $this->addSql('ALTER TABLE prestation DROP instruction_id');
    }
}
