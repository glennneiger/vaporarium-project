<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190517135519 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE characteristic_item_for_product (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, product_characteristic_id INT DEFAULT NULL, characteristic_value_id INT DEFAULT NULL, INDEX IDX_6050D8EF4584665A (product_id), INDEX IDX_6050D8EF6A6CE378 (product_characteristic_id), INDEX IDX_6050D8EF6803A39A (characteristic_value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characteristic_item_for_product ADD CONSTRAINT FK_6050D8EF4584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE characteristic_item_for_product ADD CONSTRAINT FK_6050D8EF6A6CE378 FOREIGN KEY (product_characteristic_id) REFERENCES product_characteristic (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE characteristic_item_for_product ADD CONSTRAINT FK_6050D8EF6803A39A FOREIGN KEY (characteristic_value_id) REFERENCES characteristic_value (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE characteristic_item_for_product');
    }
}
