<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240812010025 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE operation (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_attribute (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_B95D74B85E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_entity (id INT AUTO_INCREMENT NOT NULL, operation_id INT DEFAULT NULL, status_id INT DEFAULT NULL, tx_id VARCHAR(255) NOT NULL, e2e_id VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_7855362844AC3583 (operation_id), INDEX IDX_785536286BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_value_double (id INT AUTO_INCREMENT NOT NULL, transaction_entity_id INT DEFAULT NULL, transaction_attribute_id INT DEFAULT NULL, value NUMERIC(10, 0) NOT NULL, INDEX IDX_33C7784AC202E61E (transaction_entity_id), INDEX IDX_33C7784AF385FB9A (transaction_attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_value_int (id INT AUTO_INCREMENT NOT NULL, transaction_entity_id INT DEFAULT NULL, transaction_attribute_id INT DEFAULT NULL, value INT NOT NULL, INDEX IDX_483CB1EC202E61E (transaction_entity_id), INDEX IDX_483CB1EF385FB9A (transaction_attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_value_string (id INT AUTO_INCREMENT NOT NULL, transaction_entity_id INT DEFAULT NULL, transaction_attribute_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_779E380CC202E61E (transaction_entity_id), INDEX IDX_779E380CF385FB9A (transaction_attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_value_text (id INT AUTO_INCREMENT NOT NULL, transaction_entity_id INT DEFAULT NULL, transaction_attribute_id INT DEFAULT NULL, value LONGTEXT NOT NULL, INDEX IDX_7DF2CBAFC202E61E (transaction_entity_id), INDEX IDX_7DF2CBAFF385FB9A (transaction_attribute_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction_entity ADD CONSTRAINT FK_7855362844AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id)');
        $this->addSql('ALTER TABLE transaction_entity ADD CONSTRAINT FK_785536286BF700BD FOREIGN KEY (status_id) REFERENCES status (id)');
        $this->addSql('ALTER TABLE transaction_value_double ADD CONSTRAINT FK_33C7784AC202E61E FOREIGN KEY (transaction_entity_id) REFERENCES transaction_entity (id)');
        $this->addSql('ALTER TABLE transaction_value_double ADD CONSTRAINT FK_33C7784AF385FB9A FOREIGN KEY (transaction_attribute_id) REFERENCES transaction_attribute (id)');
        $this->addSql('ALTER TABLE transaction_value_int ADD CONSTRAINT FK_483CB1EC202E61E FOREIGN KEY (transaction_entity_id) REFERENCES transaction_entity (id)');
        $this->addSql('ALTER TABLE transaction_value_int ADD CONSTRAINT FK_483CB1EF385FB9A FOREIGN KEY (transaction_attribute_id) REFERENCES transaction_attribute (id)');
        $this->addSql('ALTER TABLE transaction_value_string ADD CONSTRAINT FK_779E380CC202E61E FOREIGN KEY (transaction_entity_id) REFERENCES transaction_entity (id)');
        $this->addSql('ALTER TABLE transaction_value_string ADD CONSTRAINT FK_779E380CF385FB9A FOREIGN KEY (transaction_attribute_id) REFERENCES transaction_attribute (id)');
        $this->addSql('ALTER TABLE transaction_value_text ADD CONSTRAINT FK_7DF2CBAFC202E61E FOREIGN KEY (transaction_entity_id) REFERENCES transaction_entity (id)');
        $this->addSql('ALTER TABLE transaction_value_text ADD CONSTRAINT FK_7DF2CBAFF385FB9A FOREIGN KEY (transaction_attribute_id) REFERENCES transaction_attribute (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transaction_entity DROP FOREIGN KEY FK_7855362844AC3583');
        $this->addSql('ALTER TABLE transaction_entity DROP FOREIGN KEY FK_785536286BF700BD');
        $this->addSql('ALTER TABLE transaction_value_double DROP FOREIGN KEY FK_33C7784AC202E61E');
        $this->addSql('ALTER TABLE transaction_value_double DROP FOREIGN KEY FK_33C7784AF385FB9A');
        $this->addSql('ALTER TABLE transaction_value_int DROP FOREIGN KEY FK_483CB1EC202E61E');
        $this->addSql('ALTER TABLE transaction_value_int DROP FOREIGN KEY FK_483CB1EF385FB9A');
        $this->addSql('ALTER TABLE transaction_value_string DROP FOREIGN KEY FK_779E380CC202E61E');
        $this->addSql('ALTER TABLE transaction_value_string DROP FOREIGN KEY FK_779E380CF385FB9A');
        $this->addSql('ALTER TABLE transaction_value_text DROP FOREIGN KEY FK_7DF2CBAFC202E61E');
        $this->addSql('ALTER TABLE transaction_value_text DROP FOREIGN KEY FK_7DF2CBAFF385FB9A');
        $this->addSql('DROP TABLE operation');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE transaction_attribute');
        $this->addSql('DROP TABLE transaction_entity');
        $this->addSql('DROP TABLE transaction_value_double');
        $this->addSql('DROP TABLE transaction_value_int');
        $this->addSql('DROP TABLE transaction_value_string');
        $this->addSql('DROP TABLE transaction_value_text');
    }
}
