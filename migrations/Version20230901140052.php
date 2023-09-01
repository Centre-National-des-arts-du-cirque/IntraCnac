<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230901140052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE building_ticket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE error_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE it_ticket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prestataire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ticket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vehicle_ticket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE building_ticket (id INT NOT NULL, site VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE error_type (id INT NOT NULL, lib VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE it_ticket (id INT NOT NULL, error_type_id INT DEFAULT NULL, pc_name VARCHAR(255) NOT NULL, error_code VARCHAR(255) DEFAULT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CD2C29655808DDBF ON it_ticket (error_type_id)');
        $this->addSql('CREATE TABLE prestataire (id INT NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ticket (id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date DATE NOT NULL, solved BOOLEAN NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE vehicle_ticket (id INT NOT NULL, immatriculation VARCHAR(10) NOT NULL, immat VARCHAR(10) NOT NULL, brand VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE it_ticket ADD CONSTRAINT FK_CD2C29655808DDBF FOREIGN KEY (error_type_id) REFERENCES error_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE building_ticket_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE error_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE it_ticket_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prestataire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ticket_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vehicle_ticket_id_seq CASCADE');
        $this->addSql('ALTER TABLE it_ticket DROP CONSTRAINT FK_CD2C29655808DDBF');
        $this->addSql('DROP TABLE building_ticket');
        $this->addSql('DROP TABLE error_type');
        $this->addSql('DROP TABLE it_ticket');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE vehicle_ticket');
    }
}
