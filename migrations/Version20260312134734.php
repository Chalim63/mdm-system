<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260312134734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE device_application (device_id INT NOT NULL, application_id INT NOT NULL, INDEX IDX_D6DB890794A4C7D4 (device_id), INDEX IDX_D6DB89073E030ACD (application_id), PRIMARY KEY (device_id, application_id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE device_application ADD CONSTRAINT FK_D6DB890794A4C7D4 FOREIGN KEY (device_id) REFERENCES device (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE device_application ADD CONSTRAINT FK_D6DB89073E030ACD FOREIGN KEY (application_id) REFERENCES application (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE device CHANGE note note LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE device_application DROP FOREIGN KEY FK_D6DB890794A4C7D4');
        $this->addSql('ALTER TABLE device_application DROP FOREIGN KEY FK_D6DB89073E030ACD');
        $this->addSql('DROP TABLE device_application');
        $this->addSql('ALTER TABLE device CHANGE note note VARCHAR(255) NOT NULL');
    }
}
