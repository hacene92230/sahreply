<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210105014357 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC9E45C554');
        $this->addSql('DROP INDEX IDX_67F068BC9E45C554 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP prestation_id');
        $this->addSql('ALTER TABLE prestation ADD commentaire_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADBA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_51C88FADBA9CD190 ON prestation (commentaire_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire ADD prestation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC9E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC9E45C554 ON commentaire (prestation_id)');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADBA9CD190');
        $this->addSql('DROP INDEX UNIQ_51C88FADBA9CD190 ON prestation');
        $this->addSql('ALTER TABLE prestation DROP commentaire_id');
    }
}
