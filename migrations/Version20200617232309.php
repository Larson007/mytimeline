<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200617232309 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, timeline_id INT DEFAULT NULL, year INT NOT NULL, month INT DEFAULT NULL, day INT DEFAULT NULL, hour INT DEFAULT NULL, minute INT DEFAULT NULL, second INT DEFAULT NULL, millisecond INT DEFAULT NULL, display_date VARCHAR(255) DEFAULT NULL, url VARCHAR(255) NOT NULL, caption VARCHAR(255) DEFAULT NULL, credit VARCHAR(255) DEFAULT NULL, thumbnail VARCHAR(255) DEFAULT NULL, alt VARCHAR(255) DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, link VARCHAR(255) DEFAULT NULL, link_target VARCHAR(255) DEFAULT NULL, headline VARCHAR(255) DEFAULT NULL, text VARCHAR(255) DEFAULT NULL, INDEX IDX_3BAE0AA7EDBEDD37 (timeline_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE theme_time_line (theme_id INT NOT NULL, time_line_id INT NOT NULL, INDEX IDX_B26A675659027487 (theme_id), INDEX IDX_B26A675619FCD424 (time_line_id), PRIMARY KEY(theme_id, time_line_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE time_line (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, events VARCHAR(255) NOT NULL, eras VARCHAR(255) DEFAULT NULL, scale VARCHAR(255) DEFAULT NULL, start_date INT NOT NULL, end_date INT DEFAULT NULL, text VARCHAR(255) NOT NULL, media VARCHAR(255) DEFAULT NULL, groups VARCHAR(255) DEFAULT NULL, display_date VARCHAR(255) DEFAULT NULL, background VARCHAR(255) DEFAULT NULL, autolink VARCHAR(255) DEFAULT NULL, unique_id INT DEFAULT NULL, INDEX IDX_7CA9BDDB67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7EDBEDD37 FOREIGN KEY (timeline_id) REFERENCES time_line (id)');
        $this->addSql('ALTER TABLE theme_time_line ADD CONSTRAINT FK_B26A675659027487 FOREIGN KEY (theme_id) REFERENCES theme (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE theme_time_line ADD CONSTRAINT FK_B26A675619FCD424 FOREIGN KEY (time_line_id) REFERENCES time_line (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE time_line ADD CONSTRAINT FK_7CA9BDDB67B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE theme_time_line DROP FOREIGN KEY FK_B26A675659027487');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7EDBEDD37');
        $this->addSql('ALTER TABLE theme_time_line DROP FOREIGN KEY FK_B26A675619FCD424');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE theme');
        $this->addSql('DROP TABLE theme_time_line');
        $this->addSql('DROP TABLE time_line');
    }
}
