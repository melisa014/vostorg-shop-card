<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181026185642 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE color (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, photo_path LONGTEXT DEFAULT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, firm_id INT DEFAULT NULL, vendor_code VARCHAR(100) NOT NULL, description VARCHAR(255) DEFAULT NULL, page_description LONGTEXT DEFAULT NULL, keywords LONGTEXT DEFAULT NULL, updated_at DATETIME NOT NULL, photo_path LONGTEXT DEFAULT NULL, deleted_at DATETIME DEFAULT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), INDEX IDX_D34A04AD89AF7860 (firm_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products_colors (product_id INT NOT NULL, color_id INT NOT NULL, INDEX IDX_448D48B54584665A (product_id), INDEX IDX_448D48B57ADA1FB5 (color_id), PRIMARY KEY(product_id, color_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE firm (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, label VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, page_description LONGTEXT DEFAULT NULL, keywords LONGTEXT DEFAULT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME DEFAULT NULL, photo_path LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD89AF7860 FOREIGN KEY (firm_id) REFERENCES firm (id)');
        $this->addSql('ALTER TABLE products_colors ADD CONSTRAINT FK_448D48B54584665A FOREIGN KEY (product_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE products_colors ADD CONSTRAINT FK_448D48B57ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE products_colors DROP FOREIGN KEY FK_448D48B57ADA1FB5');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE products_colors DROP FOREIGN KEY FK_448D48B54584665A');
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD89AF7860');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE products_colors');
        $this->addSql('DROP TABLE firm');
    }
}
