<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211202225421 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE secret DROP FOREIGN KEY FK_5CA2E8E5A76ED395');
        $this->addSql('DROP INDEX IDX_5CA2E8E5A76ED395 ON secret');
        $this->addSql('ALTER TABLE secret CHANGE user_id secret_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secret ADD CONSTRAINT FK_5CA2E8E567176C07 FOREIGN KEY (secret_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5CA2E8E567176C07 ON secret (secret_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE secret DROP FOREIGN KEY FK_5CA2E8E567176C07');
        $this->addSql('DROP INDEX IDX_5CA2E8E567176C07 ON secret');
        $this->addSql('ALTER TABLE secret CHANGE secret_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secret ADD CONSTRAINT FK_5CA2E8E5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5CA2E8E5A76ED395 ON secret (user_id)');
    }
}
