<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191223222854 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE income (id INT AUTO_INCREMENT NOT NULL, created_by_id INT NOT NULL, income_id INT NOT NULL, period_id INT NOT NULL, created_at DATETIME NOT NULL, planned_value DOUBLE PRECISION NOT NULL, real_value DOUBLE PRECISION NOT NULL, INDEX IDX_3FA862D0B03A8386 (created_by_id), INDEX IDX_3FA862D0640ED2C0 (income_id), INDEX IDX_3FA862D0EC8B7ADE (period_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D0B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D0640ED2C0 FOREIGN KEY (income_id) REFERENCES income_type (id)');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D0EC8B7ADE FOREIGN KEY (period_id) REFERENCES period (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE income');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
