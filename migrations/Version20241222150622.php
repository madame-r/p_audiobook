<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241222150622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audiobooks ADD genre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE audiobooks ADD CONSTRAINT FK_588F46D54296D31F FOREIGN KEY (genre_id) REFERENCES genre (id)');
        $this->addSql('CREATE INDEX IDX_588F46D54296D31F ON audiobooks (genre_id)');
        $this->addSql('ALTER TABLE chapters ADD audiobooks_id INT NOT NULL');
        $this->addSql('ALTER TABLE chapters ADD CONSTRAINT FK_C721437136274481 FOREIGN KEY (audiobooks_id) REFERENCES audiobooks (id)');
        $this->addSql('CREATE INDEX IDX_C721437136274481 ON chapters (audiobooks_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audiobooks DROP FOREIGN KEY FK_588F46D54296D31F');
        $this->addSql('DROP INDEX IDX_588F46D54296D31F ON audiobooks');
        $this->addSql('ALTER TABLE audiobooks DROP genre_id');
        $this->addSql('ALTER TABLE chapters DROP FOREIGN KEY FK_C721437136274481');
        $this->addSql('DROP INDEX IDX_C721437136274481 ON chapters');
        $this->addSql('ALTER TABLE chapters DROP audiobooks_id');
    }
}
