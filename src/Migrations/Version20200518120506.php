<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518120506 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, is_subscribeable TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE happening (id INT AUTO_INCREMENT NOT NULL, location_id INT NOT NULL, event_id INT NOT NULL, date DATE NOT NULL, time TIME NOT NULL, end_time TIME NOT NULL, max_participants INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_deleted TINYINT(1) NOT NULL, INDEX IDX_1F3C70AD64D218E (location_id), INDEX IDX_1F3C70AD71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE images (id INT AUTO_INCREMENT NOT NULL, event_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_deleted TINYINT(1) NOT NULL, INDEX IDX_E01FBE6A71F7E88B (event_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE location (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(510) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_deleted TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, img_path VARCHAR(510) DEFAULT NULL, regkey VARCHAR(255) NOT NULL, points SMALLINT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_deleted TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_happening (user_id INT NOT NULL, happening_id INT NOT NULL, INDEX IDX_1FDCFD49A76ED395 (user_id), INDEX IDX_1FDCFD49B7B10E6D (happening_id), PRIMARY KEY(user_id, happening_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE happening ADD CONSTRAINT FK_1F3C70AD64D218E FOREIGN KEY (location_id) REFERENCES location (id)');
        $this->addSql('ALTER TABLE happening ADD CONSTRAINT FK_1F3C70AD71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE images ADD CONSTRAINT FK_E01FBE6A71F7E88B FOREIGN KEY (event_id) REFERENCES event (id)');
        $this->addSql('ALTER TABLE user_happening ADD CONSTRAINT FK_1FDCFD49A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_happening ADD CONSTRAINT FK_1FDCFD49B7B10E6D FOREIGN KEY (happening_id) REFERENCES happening (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE happening DROP FOREIGN KEY FK_1F3C70AD71F7E88B');
        $this->addSql('ALTER TABLE images DROP FOREIGN KEY FK_E01FBE6A71F7E88B');
        $this->addSql('ALTER TABLE user_happening DROP FOREIGN KEY FK_1FDCFD49B7B10E6D');
        $this->addSql('ALTER TABLE happening DROP FOREIGN KEY FK_1F3C70AD64D218E');
        $this->addSql('ALTER TABLE user_happening DROP FOREIGN KEY FK_1FDCFD49A76ED395');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE happening');
        $this->addSql('DROP TABLE images');
        $this->addSql('DROP TABLE location');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_happening');
    }
}
