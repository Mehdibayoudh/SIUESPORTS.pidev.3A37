<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213165032 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team CHANGE idowner idowner INT DEFAULT NULL, CHANGE nom_team nom_team VARCHAR(255) DEFAULT NULL, CHANGE nb_joueurs nb_joueurs INT DEFAULT NULL, CHANGE about about LONGTEXT DEFAULT NULL, CHANGE logo logo VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE team CHANGE idowner idowner INT NOT NULL, CHANGE nom_team nom_team VARCHAR(255) NOT NULL, CHANGE nb_joueurs nb_joueurs INT NOT NULL, CHANGE about about LONGTEXT NOT NULL, CHANGE logo logo VARCHAR(255) NOT NULL');
    }
}
