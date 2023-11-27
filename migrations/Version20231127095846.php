<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127095846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'dear god please work ';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE bi_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE error_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE prestataire_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE ticket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_event_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE bi (id INT NOT NULL, title VARCHAR(100) NOT NULL, description VARCHAR(1000) NOT NULL, path VARCHAR(255) DEFAULT NULL, create_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, update_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, week INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN bi.create_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN bi.update_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE building_ticket (id INT NOT NULL, site VARCHAR(255) NOT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE error_type (id INT NOT NULL, heldby_id INT NOT NULL, lib VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C8A99A152A0F2509 ON error_type (heldby_id)');
        $this->addSql('CREATE TABLE event (id INT NOT NULL, type_event_id INT DEFAULT NULL, lib VARCHAR(255) NOT NULL, date_beg TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_end TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3BAE0AA7BC08CF77 ON event (type_event_id)');
        $this->addSql('CREATE TABLE it_ticket (id INT NOT NULL, error_type_id INT DEFAULT NULL, pc_name VARCHAR(255) DEFAULT NULL, error_code VARCHAR(255) DEFAULT NULL, localisation VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CD2C29655808DDBF ON it_ticket (error_type_id)');
        $this->addSql('CREATE TABLE prestataire (id INT NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(255) DEFAULT NULL, society_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ticket (id INT NOT NULL, create_by_id INT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, date DATE NOT NULL, solved BOOLEAN NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_97A0ADA39E085865 ON ticket (create_by_id)');
        $this->addSql('CREATE TABLE type_event (id INT NOT NULL, lib VARCHAR(255) NOT NULL, calendar_color VARCHAR(8) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, service VARCHAR(255) NOT NULL, post VARCHAR(255) NOT NULL, profil_picture VARCHAR(255) DEFAULT NULL, dtype VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE TABLE vehicle_ticket (id INT NOT NULL, immatriculation VARCHAR(10) NOT NULL, brand VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE building_ticket ADD CONSTRAINT FK_87167748BF396750 FOREIGN KEY (id) REFERENCES ticket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE error_type ADD CONSTRAINT FK_C8A99A152A0F2509 FOREIGN KEY (heldby_id) REFERENCES prestataire (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7BC08CF77 FOREIGN KEY (type_event_id) REFERENCES type_event (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE it_ticket ADD CONSTRAINT FK_CD2C29655808DDBF FOREIGN KEY (error_type_id) REFERENCES error_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE it_ticket ADD CONSTRAINT FK_CD2C2965BF396750 FOREIGN KEY (id) REFERENCES ticket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA39E085865 FOREIGN KEY (create_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehicle_ticket ADD CONSTRAINT FK_3E7EAC70BF396750 FOREIGN KEY (id) REFERENCES ticket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE bi_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE error_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE prestataire_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE ticket_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_event_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE building_ticket DROP CONSTRAINT FK_87167748BF396750');
        $this->addSql('ALTER TABLE error_type DROP CONSTRAINT FK_C8A99A152A0F2509');
        $this->addSql('ALTER TABLE event DROP CONSTRAINT FK_3BAE0AA7BC08CF77');
        $this->addSql('ALTER TABLE it_ticket DROP CONSTRAINT FK_CD2C29655808DDBF');
        $this->addSql('ALTER TABLE it_ticket DROP CONSTRAINT FK_CD2C2965BF396750');
        $this->addSql('ALTER TABLE ticket DROP CONSTRAINT FK_97A0ADA39E085865');
        $this->addSql('ALTER TABLE vehicle_ticket DROP CONSTRAINT FK_3E7EAC70BF396750');
        $this->addSql('DROP TABLE bi');
        $this->addSql('DROP TABLE building_ticket');
        $this->addSql('DROP TABLE error_type');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE it_ticket');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE type_event');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE vehicle_ticket');
    }
}
