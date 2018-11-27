<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181127132500 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE base_email ADD base_email_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE base_email ADD CONSTRAINT FK_5AB9EDA6E2D96231 FOREIGN KEY (base_email_id) REFERENCES base_config (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_5AB9EDA6E2D96231 ON base_email (base_email_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE base_email DROP FOREIGN KEY FK_5AB9EDA6E2D96231');
        $this->addSql('DROP INDEX IDX_5AB9EDA6E2D96231 ON base_email');
        $this->addSql('ALTER TABLE base_email DROP base_email_id');
    }
}
