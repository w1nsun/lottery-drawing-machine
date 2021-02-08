<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208204335 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prize (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, type INTEGER NOT NULL, min_sum INTEGER DEFAULT NULL, max_sum INTEGER DEFAULT NULL)');
        $this->addSql('CREATE TABLE user_prize (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, prize_id INTEGER NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B30A7099A76ED395 ON user_prize (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B30A7099BBE43214 ON user_prize (prize_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE prize');
        $this->addSql('DROP TABLE user_prize');
    }
}
