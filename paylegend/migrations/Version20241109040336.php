<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241109040336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE balance_history (id INT AUTO_INCREMENT NOT NULL, balance_id INT DEFAULT NULL, operation_id INT DEFAULT NULL, previus_amount NUMERIC(20, 8) NOT NULL, discounted_fee NUMERIC(20, 8) NOT NULL, discounted_tax NUMERIC(20, 8) NOT NULL, discounted_rate NUMERIC(20, 8) NOT NULL, amount NUMERIC(20, 8) NOT NULL, amount_with_discount NUMERIC(20, 8) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_135152F1AE91A3DD (balance_id), INDEX IDX_135152F144AC3583 (operation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE balance_history ADD CONSTRAINT FK_135152F1AE91A3DD FOREIGN KEY (balance_id) REFERENCES balance (id)');
        $this->addSql('ALTER TABLE balance_history ADD CONSTRAINT FK_135152F144AC3583 FOREIGN KEY (operation_id) REFERENCES operation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE balance_history DROP FOREIGN KEY FK_135152F1AE91A3DD');
        $this->addSql('ALTER TABLE balance_history DROP FOREIGN KEY FK_135152F144AC3583');
        $this->addSql('DROP TABLE balance_history');
    }
}
