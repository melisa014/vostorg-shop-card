<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180720062955 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE firm ADD photo_id INT DEFAULT NULL, DROP path_to_photo');
        $this->addSql('ALTER TABLE firm ADD CONSTRAINT FK_560581FD7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_560581FD7E9E4C8C ON firm (photo_id)');
        $this->addSql('ALTER TABLE photo ADD firm_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841889AF7860 FOREIGN KEY (firm_id) REFERENCES firm (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_14B7841889AF7860 ON photo (firm_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE firm DROP FOREIGN KEY FK_560581FD7E9E4C8C');
        $this->addSql('DROP INDEX UNIQ_560581FD7E9E4C8C ON firm');
        $this->addSql('ALTER TABLE firm ADD path_to_photo VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, DROP photo_id');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841889AF7860');
        $this->addSql('DROP INDEX UNIQ_14B7841889AF7860 ON photo');
        $this->addSql('ALTER TABLE photo DROP firm_id');
    }
}
