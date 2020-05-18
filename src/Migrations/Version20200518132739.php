<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200518132739 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE attendee (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, happening_id INT NOT NULL, is_reserve TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_deleted TINYINT(1) NOT NULL, INDEX IDX_1150D567A76ED395 (user_id), INDEX IDX_1150D567B7B10E6D (happening_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE attendee ADD CONSTRAINT FK_1150D567A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE attendee ADD CONSTRAINT FK_1150D567B7B10E6D FOREIGN KEY (happening_id) REFERENCES happening (id)');
        $this->addSql('DROP TABLE user_happening');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_happening (user_id INT NOT NULL, happening_id INT NOT NULL, INDEX IDX_1FDCFD49A76ED395 (user_id), INDEX IDX_1FDCFD49B7B10E6D (happening_id), PRIMARY KEY(user_id, happening_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE user_happening ADD CONSTRAINT FK_1FDCFD49A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_happening ADD CONSTRAINT FK_1FDCFD49B7B10E6D FOREIGN KEY (happening_id) REFERENCES happening (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE attendee');
    }
}
