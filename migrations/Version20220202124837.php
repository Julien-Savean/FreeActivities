<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220202124837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user_sport');
        $this->addSql('ALTER TABLE activity DROP FOREIGN KEY FK_AC74095AA76ED395');
        $this->addSql('DROP INDEX IDX_AC74095AA76ED395 ON activity');
        $this->addSql('ALTER TABLE activity DROP user_id');
        $this->addSql('ALTER TABLE user ADD password VARCHAR(255) NOT NULL, DROP firstname, DROP lastname, DROP age, DROP city, DROP picture');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_sport (user_id INT NOT NULL, sport_id INT NOT NULL, INDEX IDX_F847148AA76ED395 (user_id), INDEX IDX_F847148AAC78BCF8 (sport_id), PRIMARY KEY(user_id, sport_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_sport ADD CONSTRAINT FK_F847148AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_sport ADD CONSTRAINT FK_F847148AAC78BCF8 FOREIGN KEY (sport_id) REFERENCES sport (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE activity ADD user_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE picture picture VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE activity ADD CONSTRAINT FK_AC74095AA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_AC74095AA76ED395 ON activity (user_id)');
        $this->addSql('ALTER TABLE sport CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user ADD firstname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD lastname VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD age INT DEFAULT NULL, ADD city VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD picture VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP password, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
