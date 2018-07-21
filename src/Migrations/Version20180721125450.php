<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180721125450 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE color ADD photo_path LONGTEXT DEFAULT NULL, DROP name, DROP path_to_photo, DROP created_at');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD7E9E4C8C');
        $this->addSql('DROP INDEX UNIQ_D34A04AD7E9E4C8C ON product');
        $this->addSql('ALTER TABLE product ADD photo_path LONGTEXT DEFAULT NULL, DROP photo_id, DROP name, DROP created_at');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE color ADD name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD path_to_photo VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD created_at DATETIME NOT NULL, DROP photo_path');
        $this->addSql('ALTER TABLE product ADD photo_id INT DEFAULT NULL, ADD name VARCHAR(255) DEFAULT NULL COLLATE utf8_unicode_ci, ADD created_at DATETIME NOT NULL, DROP photo_path');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD7E9E4C8C FOREIGN KEY (photo_id) REFERENCES photo (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_D34A04AD7E9E4C8C ON product (photo_id)');
    }
}
