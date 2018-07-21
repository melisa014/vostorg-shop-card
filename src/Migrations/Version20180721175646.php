<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180721175646 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE firm ADD deleted_at DATETIME DEFAULT NULL, ADD photo_path LONGTEXT DEFAULT NULL, DROP created_at');
        $this->addSql('ALTER TABLE photo DROP INDEX IDX_14B784184584665A, ADD UNIQUE INDEX UNIQ_14B784184584665A (product_id)');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784184584665A');
        $this->addSql('ALTER TABLE photo ADD firm_id INT DEFAULT NULL, ADD description LONGTEXT DEFAULT NULL, DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B7841889AF7860 FOREIGN KEY (firm_id) REFERENCES firm (id)');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784184584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_14B7841889AF7860 ON photo (firm_id)');
        $this->addSql('ALTER TABLE product ADD photo_path LONGTEXT DEFAULT NULL, ADD deleted_at DATETIME DEFAULT NULL, DROP name, DROP price, DROP created_at, CHANGE description description LONGTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE color ADD label VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE color DROP label');
        $this->addSql('ALTER TABLE firm ADD created_at DATETIME NOT NULL, DROP deleted_at, DROP photo_path');
        $this->addSql('ALTER TABLE photo DROP INDEX UNIQ_14B784184584665A, ADD INDEX IDX_14B784184584665A (product_id)');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B7841889AF7860');
        $this->addSql('ALTER TABLE photo DROP FOREIGN KEY FK_14B784184584665A');
        $this->addSql('DROP INDEX UNIQ_14B7841889AF7860 ON photo');
        $this->addSql('ALTER TABLE photo ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP firm_id, DROP description');
        $this->addSql('ALTER TABLE photo ADD CONSTRAINT FK_14B784184584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product ADD name VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci, ADD price INT NOT NULL, ADD created_at DATETIME NOT NULL, DROP photo_path, DROP deleted_at, CHANGE description description LONGTEXT NOT NULL COLLATE utf8_unicode_ci');
    }
}
