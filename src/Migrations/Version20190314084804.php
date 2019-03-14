<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190314084804 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE backlog ADD created_by_id INT DEFAULT NULL, ADD updated_by_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE backlog ADD CONSTRAINT FK_269205B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE backlog ADD CONSTRAINT FK_269205896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_269205B03A8386 ON backlog (created_by_id)');
        $this->addSql('CREATE INDEX IDX_269205896DBBDE ON backlog (updated_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE backlog DROP FOREIGN KEY FK_269205B03A8386');
        $this->addSql('ALTER TABLE backlog DROP FOREIGN KEY FK_269205896DBBDE');
        $this->addSql('DROP INDEX IDX_269205B03A8386 ON backlog');
        $this->addSql('DROP INDEX IDX_269205896DBBDE ON backlog');
        $this->addSql('ALTER TABLE backlog DROP created_by_id, DROP updated_by_id, DROP created_at, DROP updated_at');
    }
}
