<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191223225528 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE income DROP FOREIGN KEY FK_3FA862D0640ED2C0');
        $this->addSql('DROP INDEX IDX_3FA862D0640ED2C0 ON income');
        $this->addSql('ALTER TABLE income CHANGE income_id income_type_id INT NOT NULL');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D07D0EFAEA FOREIGN KEY (income_type_id) REFERENCES income_type (id)');
        $this->addSql('CREATE INDEX IDX_3FA862D07D0EFAEA ON income (income_type_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE income DROP FOREIGN KEY FK_3FA862D07D0EFAEA');
        $this->addSql('DROP INDEX IDX_3FA862D07D0EFAEA ON income');
        $this->addSql('ALTER TABLE income CHANGE income_type_id income_id INT NOT NULL');
        $this->addSql('ALTER TABLE income ADD CONSTRAINT FK_3FA862D0640ED2C0 FOREIGN KEY (income_id) REFERENCES income_type (id)');
        $this->addSql('CREATE INDEX IDX_3FA862D0640ED2C0 ON income (income_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
