<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190516113048 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE characteristic_item_for_category (id INT AUTO_INCREMENT NOT NULL, characteristic_item_for_category_id INT DEFAULT NULL, characteristic_product_id INT DEFAULT NULL, INDEX IDX_9E2D23A1458DD9ED (characteristic_item_for_category_id), INDEX IDX_9E2D23A14177D3D4 (characteristic_product_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characteristic_item_for_category ADD CONSTRAINT FK_9E2D23A1458DD9ED FOREIGN KEY (characteristic_item_for_category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE characteristic_item_for_category ADD CONSTRAINT FK_9E2D23A14177D3D4 FOREIGN KEY (characteristic_product_id) REFERENCES product_characteristic (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE characteristic_item_for_category');
    }
}
