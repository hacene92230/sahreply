<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210203520 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_prestation');
        $this->addSql('ALTER TABLE prestation_statut DROP FOREIGN KEY FK_7F19C8429E45C554');
        $this->addSql('DROP INDEX IDX_7F19C8429E45C554 ON prestation_statut');
        $this->addSql('ALTER TABLE prestation_statut DROP prestation_id');
        $this->addSql('ALTER TABLE prestation_type DROP FOREIGN KEY FK_D06A71959E45C554');
        $this->addSql('DROP INDEX IDX_D06A71959E45C554 ON prestation_type');
        $this->addSql('ALTER TABLE prestation_type DROP prestation_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_prestation (user_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_F6AF49419E45C554 (prestation_id), INDEX IDX_F6AF4941A76ED395 (user_id), PRIMARY KEY(user_id, prestation_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_prestation ADD CONSTRAINT FK_F6AF49419E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_prestation ADD CONSTRAINT FK_F6AF4941A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation_statut ADD prestation_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation_statut ADD CONSTRAINT FK_7F19C8429E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('CREATE INDEX IDX_7F19C8429E45C554 ON prestation_statut (prestation_id)');
        $this->addSql('ALTER TABLE prestation_type ADD prestation_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation_type ADD CONSTRAINT FK_D06A71959E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('CREATE INDEX IDX_D06A71959E45C554 ON prestation_type (prestation_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
