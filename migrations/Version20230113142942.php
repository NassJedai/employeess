<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230113142942 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE demands (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, type VARCHAR(15) NOT NULL, about VARCHAR(15) NOT NULL, status TINYINT(1) NOT NULL, INDEX IDX_D24062F48C03F15C (employee_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE demands ADD CONSTRAINT FK_D24062F48C03F15C FOREIGN KEY (employee_id) REFERENCES employees (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demands DROP FOREIGN KEY FK_D24062F48C03F15C');
        $this->addSql('DROP TABLE demands');
    }
}
