<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208080858 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADA76ED395');
        $this->addSql('DROP INDEX IDX_51C88FADA76ED395 ON prestation');
        $this->addSql('ALTER TABLE prestation ADD statut_id INT NOT NULL, ADD type_id INT NOT NULL, DROP user_id, DROP statut');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADF6203804 FOREIGN KEY (statut_id) REFERENCES prestation_statut (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADC54C8C93 FOREIGN KEY (type_id) REFERENCES prestation_type (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_51C88FADF6203804 ON prestation (statut_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_51C88FADC54C8C93 ON prestation (type_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADF6203804');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADC54C8C93');
        $this->addSql('DROP INDEX UNIQ_51C88FADF6203804 ON prestation');
        $this->addSql('DROP INDEX UNIQ_51C88FADC54C8C93 ON prestation');
        $this->addSql('ALTER TABLE prestation ADD user_id INT DEFAULT NULL, ADD statut TINYINT(1) NOT NULL, DROP statut_id, DROP type_id');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_51C88FADA76ED395 ON prestation (user_id)');
    }
}
