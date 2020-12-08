<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208120906 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADC54C8C93');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADF6203804');
        $this->addSql('DROP INDEX UNIQ_51C88FADC54C8C93 ON prestation');
        $this->addSql('DROP INDEX UNIQ_51C88FADF6203804 ON prestation');
        $this->addSql('ALTER TABLE prestation DROP statut_id, DROP type_id');
        $this->addSql('ALTER TABLE prestation_statut ADD prestation_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation_statut ADD CONSTRAINT FK_7F19C8429E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('CREATE INDEX IDX_7F19C8429E45C554 ON prestation_statut (prestation_id)');
        $this->addSql('ALTER TABLE prestation_type ADD prestation_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation_type ADD CONSTRAINT FK_D06A71959E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('CREATE INDEX IDX_D06A71959E45C554 ON prestation_type (prestation_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation ADD statut_id INT NOT NULL, ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADC54C8C93 FOREIGN KEY (type_id) REFERENCES prestation_type (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADF6203804 FOREIGN KEY (statut_id) REFERENCES prestation_statut (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_51C88FADC54C8C93 ON prestation (type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_51C88FADF6203804 ON prestation (statut_id)');
        $this->addSql('ALTER TABLE prestation_statut DROP FOREIGN KEY FK_7F19C8429E45C554');
        $this->addSql('DROP INDEX IDX_7F19C8429E45C554 ON prestation_statut');
        $this->addSql('ALTER TABLE prestation_statut DROP prestation_id');
        $this->addSql('ALTER TABLE prestation_type DROP FOREIGN KEY FK_D06A71959E45C554');
        $this->addSql('DROP INDEX IDX_D06A71959E45C554 ON prestation_type');
        $this->addSql('ALTER TABLE prestation_type DROP prestation_id');
    }
}
