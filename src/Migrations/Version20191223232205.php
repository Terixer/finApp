<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191223232205 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE planned_expense (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, expense_type_id INT NOT NULL, period_id INT NOT NULL, created_at DATETIME NOT NULL, value DOUBLE PRECISION NOT NULL, INDEX IDX_6D126A92B03A8386 (created_by_id), INDEX IDX_6D126A92A857C7A9 (expense_type_id), INDEX IDX_6D126A92EC8B7ADE (period_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE planned_expense ADD CONSTRAINT FK_6D126A92B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE planned_expense ADD CONSTRAINT FK_6D126A92A857C7A9 FOREIGN KEY (expense_type_id) REFERENCES expense_type (id)');
        $this->addSql('ALTER TABLE planned_expense ADD CONSTRAINT FK_6D126A92EC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE planned_expense');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
