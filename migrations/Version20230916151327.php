<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230916151327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE building_ticket_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE it_ticket_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE vehicle_ticket_id_seq CASCADE');
        $this->addSql('ALTER TABLE building_ticket ADD CONSTRAINT FK_87167748BF396750 FOREIGN KEY (id) REFERENCES ticket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE it_ticket ADD CONSTRAINT FK_CD2C2965BF396750 FOREIGN KEY (id) REFERENCES ticket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehicle_ticket ADD CONSTRAINT FK_3E7EAC70BF396750 FOREIGN KEY (id) REFERENCES ticket (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE building_ticket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE it_ticket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE vehicle_ticket_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('ALTER TABLE building_ticket DROP CONSTRAINT FK_87167748BF396750');
        $this->addSql('ALTER TABLE vehicle_ticket DROP CONSTRAINT FK_3E7EAC70BF396750');
        $this->addSql('ALTER TABLE it_ticket DROP CONSTRAINT FK_CD2C2965BF396750');
    }
}
