<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241109011913 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE balance (id INT AUTO_INCREMENT NOT NULL, partner_id INT DEFAULT NULL, country_id INT DEFAULT NULL, amount NUMERIC(20, 8) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_ACF41FFE9393F8FE (partner_id), INDEX IDX_ACF41FFEF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT AUTO_INCREMENT NOT NULL, country_name VARCHAR(255) NOT NULL, country_acronym VARCHAR(4) NOT NULL, country_currency VARCHAR(6) NOT NULL, country_currency_acronym VARCHAR(4) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fee (id INT AUTO_INCREMENT NOT NULL, partner_id INT DEFAULT NULL, operation_id INT DEFAULT NULL, country_id INT DEFAULT NULL, value NUMERIC(20, 8) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_964964B59393F8FE (partner_id), INDEX IDX_964964B544AC3583 (operation_id), INDEX IDX_964964B5F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tax (id INT AUTO_INCREMENT NOT NULL, partner_id INT DEFAULT NULL, operation_id INT DEFAULT NULL, country_id INT DEFAULT NULL, value NUMERIC(20, 8) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8E81BA769393F8FE (partner_id), INDEX IDX_8E81BA7644AC3583 (operation_id), INDEX IDX_8E81BA76F92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE balance ADD CONSTRAINT FK_ACF41FFE9393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE balance ADD CONSTRAINT FK_ACF41FFEF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE fee ADD CONSTRAINT FK_964964B59393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE fee ADD CONSTRAINT FK_964964B544AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE fee ADD CONSTRAINT FK_964964B5F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE tax ADD CONSTRAINT FK_8E81BA769393F8FE FOREIGN KEY (partner_id) REFERENCES partner (id)');
        $this->addSql('ALTER TABLE tax ADD CONSTRAINT FK_8E81BA7644AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE tax ADD CONSTRAINT FK_8E81BA76F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE balance DROP FOREIGN KEY FK_ACF41FFE9393F8FE');
        $this->addSql('ALTER TABLE balance DROP FOREIGN KEY FK_ACF41FFEF92F3E70');
        $this->addSql('ALTER TABLE fee DROP FOREIGN KEY FK_964964B59393F8FE');
        $this->addSql('ALTER TABLE fee DROP FOREIGN KEY FK_964964B544AC3583');
        $this->addSql('ALTER TABLE fee DROP FOREIGN KEY FK_964964B5F92F3E70');
        $this->addSql('ALTER TABLE tax DROP FOREIGN KEY FK_8E81BA769393F8FE');
        $this->addSql('ALTER TABLE tax DROP FOREIGN KEY FK_8E81BA7644AC3583');
        $this->addSql('ALTER TABLE tax DROP FOREIGN KEY FK_8E81BA76F92F3E70');
        $this->addSql('DROP TABLE balance');
        $this->addSql('DROP TABLE country');
        $this->addSql('DROP TABLE fee');
        $this->addSql('DROP TABLE tax');
    }
}
