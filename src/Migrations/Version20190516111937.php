<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516111937 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE characteristic_item_for_category (id INT AUTO_INCREMENT NOT NULL, characteristic_item_for_category_id INT DEFAULT NULL, characteristic_product VARCHAR(255) DEFAULT NULL, INDEX IDX_9E2D23A1458DD9ED (characteristic_item_for_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characteristic_item_for_category ADD CONSTRAINT FK_9E2D23A1458DD9ED FOREIGN KEY (characteristic_item_for_category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE product_characteristic ADD characteristic_item_for_category VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE characteristic_item_for_category');
        $this->addSql('ALTER TABLE product_characteristic DROP characteristic_item_for_category');
    }
}
