<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190514115729 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE characteristic_value (id INT AUTO_INCREMENT NOT NULL, characteristic_value_id INT DEFAULT NULL, value VARCHAR(255) NOT NULL, INDEX IDX_719F040E6803A39A (characteristic_value_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product_characteristic (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, search_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characteristic_value ADD CONSTRAINT FK_719F040E6803A39A FOREIGN KEY (characteristic_value_id) REFERENCES product_characteristic (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE characteristic_value DROP FOREIGN KEY FK_719F040E6803A39A');
        $this->addSql('DROP TABLE characteristic_value');
        $this->addSql('DROP TABLE product_characteristic');
    }
}
