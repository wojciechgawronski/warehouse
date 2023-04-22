<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230422080402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article_in_stock (id INT AUTO_INCREMENT NOT NULL, article_id INT DEFAULT NULL, created_by_id INT NOT NULL, file VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', amount INT NOT NULL, remaining_amount BIGINT NOT NULL, article_operation_type VARCHAR(255) NOT NULL, INDEX IDX_542BBC757294869C (article_id), INDEX IDX_542BBC75B03A8386 (created_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article_in_stock ADD CONSTRAINT FK_542BBC757294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE article_in_stock ADD CONSTRAINT FK_542BBC75B03A8386 FOREIGN KEY (created_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_in_stock DROP FOREIGN KEY FK_542BBC757294869C');
        $this->addSql('ALTER TABLE article_in_stock DROP FOREIGN KEY FK_542BBC75B03A8386');
        $this->addSql('DROP TABLE article_in_stock');
    }
}
