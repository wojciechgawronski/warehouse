<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428133043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE amount_in_stock amount_in_stock BIGINT NOT NULL');
        $this->addSql('ALTER TABLE article_in_stock CHANGE article_operation_type operation_type VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article CHANGE amount_in_stock amount_in_stock BIGINT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE article_in_stock CHANGE operation_type article_operation_type VARCHAR(255) NOT NULL');
    }
}
