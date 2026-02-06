<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260205223405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY `FK_5A8A6C8DA8E0DB2B`');
        $this->addSql('DROP INDEX IDX_5A8A6C8DA8E0DB2B ON post');
        $this->addSql('ALTER TABLE post CHANGE updated_at updated_at DATETIME DEFAULT NULL, CHANGE cateroty_id category_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D12469DE2 ON post (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D12469DE2');
        $this->addSql('DROP INDEX IDX_5A8A6C8D12469DE2 ON post');
        $this->addSql('ALTER TABLE post CHANGE updated_at updated_at DATETIME NOT NULL, CHANGE category_id cateroty_id INT NOT NULL');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT `FK_5A8A6C8DA8E0DB2B` FOREIGN KEY (cateroty_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_5A8A6C8DA8E0DB2B ON post (cateroty_id)');
    }
}
