<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241222150056 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audiobooks ADD authors_id INT NOT NULL');
        $this->addSql('ALTER TABLE audiobooks ADD CONSTRAINT FK_588F46D56DE2013A FOREIGN KEY (authors_id) REFERENCES authors (id)');
        $this->addSql('CREATE INDEX IDX_588F46D56DE2013A ON audiobooks (authors_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE audiobooks DROP FOREIGN KEY FK_588F46D56DE2013A');
        $this->addSql('DROP INDEX IDX_588F46D56DE2013A ON audiobooks');
        $this->addSql('ALTER TABLE audiobooks DROP authors_id');
    }
}
