<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260323202802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add missing class_id column to character table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE character ADD COLUMN class_id_id INTEGER DEFAULT NULL REFERENCES character_class (id)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE TEMPORARY TABLE __temp__character AS SELECT id, name, level, str, dex, con, int, wis, cha, hit_points, image, id_user_id, id_race_id FROM character');
        $this->addSql('DROP TABLE character');
        $this->addSql('CREATE TABLE character (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, level INTEGER NOT NULL, str INTEGER NOT NULL, dex INTEGER NOT NULL, con INTEGER NOT NULL, int INTEGER NOT NULL, wis INTEGER NOT NULL, cha INTEGER NOT NULL, hit_points INTEGER NOT NULL, image VARCHAR(255) DEFAULT NULL, id_user_id INTEGER NOT NULL, id_race_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO character SELECT id, name, level, str, dex, con, int, wis, cha, hit_points, image, id_user_id, id_race_id FROM __temp__character');
        $this->addSql('DROP TABLE __temp__character');
    }
}
