<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210117133344 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE project_projects (id VARCHAR(255) NOT NULL, user_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_61DD387FA76ED395 ON project_projects (user_id)');
        $this->addSql('CREATE TABLE project_tables (id VARCHAR(255) NOT NULL, project_id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, definition JSON NOT NULL, dom_element_coordinates JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_93E3E96B166D1F9C ON project_tables (project_id)');
        $this->addSql('CREATE TABLE user_users (id VARCHAR(255) NOT NULL, email VARCHAR(255) DEFAULT NULL, password_hash VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, confirm_token VARCHAR(255) DEFAULT NULL, status VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, name_last VARCHAR(255) DEFAULT NULL, name_first VARCHAR(255) DEFAULT NULL, name_middle VARCHAR(255) DEFAULT NULL, reset_token_token VARCHAR(255) DEFAULT NULL, reset_token_expires TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN user_users.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN user_users.reset_token_expires IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE project_projects ADD CONSTRAINT FK_61DD387FA76ED395 FOREIGN KEY (user_id) REFERENCES user_users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE project_tables ADD CONSTRAINT FK_93E3E96B166D1F9C FOREIGN KEY (project_id) REFERENCES project_projects (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE project_tables DROP CONSTRAINT FK_93E3E96B166D1F9C');
        $this->addSql('ALTER TABLE project_projects DROP CONSTRAINT FK_61DD387FA76ED395');
        $this->addSql('DROP TABLE project_projects');
        $this->addSql('DROP TABLE project_tables');
        $this->addSql('DROP TABLE user_users');
    }
}
