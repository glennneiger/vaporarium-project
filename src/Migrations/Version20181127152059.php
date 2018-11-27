<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181127152059 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE base_social ADD base_social_id INT DEFAULT NULL, ADD image_name VARCHAR(255) DEFAULT NULL, ADD image_size INT DEFAULT NULL, ADD image_type VARCHAR(255) DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE base_social ADD CONSTRAINT FK_190179EE4CC7CAAA FOREIGN KEY (base_social_id) REFERENCES base_config (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_190179EE4CC7CAAA ON base_social (base_social_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE base_social DROP FOREIGN KEY FK_190179EE4CC7CAAA');
        $this->addSql('DROP INDEX IDX_190179EE4CC7CAAA ON base_social');
        $this->addSql('ALTER TABLE base_social DROP base_social_id, DROP image_name, DROP image_size, DROP image_type, DROP updated_at');
    }
}
