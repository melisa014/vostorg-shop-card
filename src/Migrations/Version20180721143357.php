<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180721143357 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE firm DROP FOREIGN KEY FK_560581FD7E9E4C8C');
        $this->addSql('DROP INDEX UNIQ_560581FD7E9E4C8C ON firm');
        $this->addSql('ALTER TABLE firm ADD photo_path LONGTEXT DEFAULT NULL, DROP photo_id, DROP created_at');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE firm ADD photo_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL, DROP photo_path');
        $this->addSql('ALTER TABLE firm ADD CONSTRAINT FK_560581FD7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_560581FD7E9E4C8C ON firm (photo_id)');
    }
}
