<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230114084504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departements ADD CONSTRAINT FK_CF7489B2FAA571DB FOREIGN KEY (dept_manager_id) REFERENCES dept_manager (id)');
        $this->addSql('CREATE INDEX IDX_CF7489B2FAA571DB ON departements (dept_manager_id)');
        $this->addSql('ALTER TABLE dept_emp ADD departement_id INT NOT NULL');
        $this->addSql('ALTER TABLE dept_emp ADD CONSTRAINT FK_B2592B4DCCF9E01E FOREIGN KEY (departement_id) REFERENCES departements (id)');
        $this->addSql('CREATE INDEX IDX_B2592B4DCCF9E01E ON dept_emp (departement_id)');
        $this->addSql('ALTER TABLE employees ADD salaries_id INT NOT NULL, ADD dept_manager_id INT NOT NULL, ADD dept_emp_id INT NOT NULL, ADD titles_id INT NOT NULL');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C30071204C38 FOREIGN KEY (salaries_id) REFERENCES salaries (id)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300FAA571DB FOREIGN KEY (dept_manager_id) REFERENCES dept_manager (id)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C3007AC4CF28 FOREIGN KEY (dept_emp_id) REFERENCES dept_emp (id)');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C30052ABED93 FOREIGN KEY (titles_id) REFERENCES titles (id)');
        $this->addSql('CREATE INDEX IDX_BA82C30071204C38 ON employees (salaries_id)');
        $this->addSql('CREATE INDEX IDX_BA82C300FAA571DB ON employees (dept_manager_id)');
        $this->addSql('CREATE INDEX IDX_BA82C3007AC4CF28 ON employees (dept_emp_id)');
        $this->addSql('CREATE INDEX IDX_BA82C30052ABED93 ON employees (titles_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE departements DROP FOREIGN KEY FK_CF7489B2FAA571DB');
        $this->addSql('DROP INDEX IDX_CF7489B2FAA571DB ON departements');
        $this->addSql('ALTER TABLE dept_emp DROP FOREIGN KEY FK_B2592B4DCCF9E01E');
        $this->addSql('DROP INDEX IDX_B2592B4DCCF9E01E ON dept_emp');
        $this->addSql('ALTER TABLE dept_emp DROP departement_id');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C30071204C38');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C300FAA571DB');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C3007AC4CF28');
        $this->addSql('ALTER TABLE employees DROP FOREIGN KEY FK_BA82C30052ABED93');
        $this->addSql('DROP INDEX IDX_BA82C30071204C38 ON employees');
        $this->addSql('DROP INDEX IDX_BA82C300FAA571DB ON employees');
        $this->addSql('DROP INDEX IDX_BA82C3007AC4CF28 ON employees');
        $this->addSql('DROP INDEX IDX_BA82C30052ABED93 ON employees');
        $this->addSql('ALTER TABLE employees DROP salaries_id, DROP dept_manager_id, DROP dept_emp_id, DROP titles_id');
    }
}
