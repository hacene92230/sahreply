<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210223071109 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, cv VARCHAR(255) NOT NULL, motivation VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_2694D7A5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande_prestation_type (demande_id INT NOT NULL, prestation_type_id INT NOT NULL, INDEX IDX_28C30EC880E95E18 (demande_id), INDEX IDX_28C30EC86DA7F0A (prestation_type_id), PRIMARY KEY(demande_id, prestation_type_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE demande_prestation_type ADD CONSTRAINT FK_28C30EC880E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande_prestation_type ADD CONSTRAINT FK_28C30EC86DA7F0A FOREIGN KEY (prestation_type_id) REFERENCES prestation_type (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande_prestation_type DROP FOREIGN KEY FK_28C30EC880E95E18');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE demande_prestation_type');
    }
}
