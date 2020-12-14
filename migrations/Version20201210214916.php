<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201210214916 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_prestation');
        $this->addSql('ALTER TABLE prestation ADD user_id INT DEFAULT NULL, ADD type_id INT NOT NULL, ADD statut_id INT NOT NULL');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADC54C8C93 FOREIGN KEY (type_id) REFERENCES prestation_type (id)');
        $this->addSql('ALTER TABLE prestation ADD CONSTRAINT FK_51C88FADF6203804 FOREIGN KEY (statut_id) REFERENCES prestation_statut (id)');
        $this->addSql('CREATE INDEX IDX_51C88FADA76ED395 ON prestation (user_id)');
        $this->addSql('CREATE INDEX IDX_51C88FADC54C8C93 ON prestation (type_id)');
        $this->addSql('CREATE INDEX IDX_51C88FADF6203804 ON prestation (statut_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_prestation (user_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_F6AF49419E45C554 (prestation_id), INDEX IDX_F6AF4941A76ED395 (user_id), PRIMARY KEY(user_id, prestation_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_prestation ADD CONSTRAINT FK_F6AF49419E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_prestation ADD CONSTRAINT FK_F6AF4941A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADA76ED395');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADC54C8C93');
        $this->addSql('ALTER TABLE prestation DROP FOREIGN KEY FK_51C88FADF6203804');
        $this->addSql('DROP INDEX IDX_51C88FADA76ED395 ON prestation');
        $this->addSql('DROP INDEX IDX_51C88FADC54C8C93 ON prestation');
        $this->addSql('DROP INDEX IDX_51C88FADF6203804 ON prestation');
        $this->addSql('ALTER TABLE prestation DROP user_id, DROP type_id, DROP statut_id');
    }
}
