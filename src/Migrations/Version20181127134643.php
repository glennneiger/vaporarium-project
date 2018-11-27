<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181127134643 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE base_phones ADD base_phone_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE base_phones ADD CONSTRAINT FK_8B48B69C71988033 FOREIGN KEY (base_phone_id) REFERENCES base_config (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8B48B69C71988033 ON base_phones (base_phone_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE base_phones DROP FOREIGN KEY FK_8B48B69C71988033');
        $this->addSql('DROP INDEX IDX_8B48B69C71988033 ON base_phones');
        $this->addSql('ALTER TABLE base_phones DROP base_phone_id');
    }
}
