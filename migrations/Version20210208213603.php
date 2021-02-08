<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210208213603 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_B30A7099BBE43214');
        $this->addSql('DROP INDEX UNIQ_B30A7099A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_prize AS SELECT id, user_id, prize_id FROM user_prize');
        $this->addSql('DROP TABLE user_prize');
        $this->addSql('CREATE TABLE user_prize (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, prize_id INTEGER NOT NULL, CONSTRAINT FK_B30A7099A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_B30A7099BBE43214 FOREIGN KEY (prize_id) REFERENCES prize (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_prize (id, user_id, prize_id) SELECT id, user_id, prize_id FROM __temp__user_prize');
        $this->addSql('DROP TABLE __temp__user_prize');
        $this->addSql('CREATE INDEX IDX_B30A7099A76ED395 ON user_prize (user_id)');
        $this->addSql('CREATE INDEX IDX_B30A7099BBE43214 ON user_prize (prize_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_B30A7099A76ED395');
        $this->addSql('DROP INDEX IDX_B30A7099BBE43214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_prize AS SELECT id, user_id, prize_id FROM user_prize');
        $this->addSql('DROP TABLE user_prize');
        $this->addSql('CREATE TABLE user_prize (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER NOT NULL, prize_id INTEGER NOT NULL)');
        $this->addSql('INSERT INTO user_prize (id, user_id, prize_id) SELECT id, user_id, prize_id FROM __temp__user_prize');
        $this->addSql('DROP TABLE __temp__user_prize');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B30A7099BBE43214 ON user_prize (prize_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B30A7099A76ED395 ON user_prize (user_id)');
    }
}
