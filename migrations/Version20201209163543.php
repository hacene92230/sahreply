<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201209163543 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prestation (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL, nbheure INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation_statut (id INT AUTO_INCREMENT NOT NULL, prestation_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_7F19C8429E45C554 (prestation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestation_type (id INT AUTO_INCREMENT NOT NULL, prestation_id INT NOT NULL, nom VARCHAR(255) NOT NULL, tarif INT NOT NULL, INDEX IDX_D06A71959E45C554 (prestation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, postalcode INT NOT NULL, city VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, phone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_prestation (user_id INT NOT NULL, prestation_id INT NOT NULL, INDEX IDX_F6AF4941A76ED395 (user_id), INDEX IDX_F6AF49419E45C554 (prestation_id), PRIMARY KEY(user_id, prestation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prestation_statut ADD CONSTRAINT FK_7F19C8429E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('ALTER TABLE prestation_type ADD CONSTRAINT FK_D06A71959E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id)');
        $this->addSql('ALTER TABLE user_prestation ADD CONSTRAINT FK_F6AF4941A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_prestation ADD CONSTRAINT FK_F6AF49419E45C554 FOREIGN KEY (prestation_id) REFERENCES prestation (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestation_statut DROP FOREIGN KEY FK_7F19C8429E45C554');
        $this->addSql('ALTER TABLE prestation_type DROP FOREIGN KEY FK_D06A71959E45C554');
        $this->addSql('ALTER TABLE user_prestation DROP FOREIGN KEY FK_F6AF49419E45C554');
        $this->addSql('ALTER TABLE user_prestation DROP FOREIGN KEY FK_F6AF4941A76ED395');
        $this->addSql('DROP TABLE prestation');
        $this->addSql('DROP TABLE prestation_statut');
        $this->addSql('DROP TABLE prestation_type');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_prestation');
    }
}
