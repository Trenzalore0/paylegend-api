<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240811235717 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE partner (id INT AUTO_INCREMENT NOT NULL, partner_name VARCHAR(255) NOT NULL, partner_key VARCHAR(255) NOT NULL, partner_secret VARCHAR(255) NOT NULL, partner_wdpass VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_312B3E16BBD28FD9 (partner_key), UNIQUE INDEX UNIQ_312B3E166169419E (partner_secret), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_endpoint (id INT AUTO_INCREMENT NOT NULL, partner_id INT DEFAULT NULL, endpoint_cashin VARCHAR(255) DEFAULT NULL, endpoint_cashout VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_A78389C19393F8FE (partner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE partner_user (id INT AUTO_INCREMENT NOT NULL, partner_id INT DEFAULT NULL, role_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_DDA7E551E7927C74 (email), INDEX IDX_DDA7E5519393F8FE (partner_id), INDEX IDX_DDA7E551D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE partner_endpoint ADD CONSTRAINT FK_A78389C19393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE partner_user ADD CONSTRAINT FK_DDA7E5519393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE partner_user ADD CONSTRAINT FK_DDA7E551D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE partner_endpoint DROP FOREIGN KEY FK_A78389C19393F8FE');
        $this->addSql('ALTER TABLE partner_user DROP FOREIGN KEY FK_DDA7E5519393F8FE');
        $this->addSql('ALTER TABLE partner_user DROP FOREIGN KEY FK_DDA7E551D60322AC');
        $this->addSql('DROP TABLE partner');
        $this->addSql('DROP TABLE partner_endpoint');
        $this->addSql('DROP TABLE partner_user');
        $this->addSql('DROP TABLE role');
    }
}
