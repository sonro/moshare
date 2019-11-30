<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191130162006 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, portfolio_id INT DEFAULT NULL, ledger_id INT DEFAULT NULL, name VARCHAR(190) NOT NULL, INDEX IDX_7D3656A4B96B5643 (portfolio_id), INDEX IDX_7D3656A4A7B913DD (ledger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ledger (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(190) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE portfolio (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(190) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(190) NOT NULL, firstname VARCHAR(190) NOT NULL, lastname VARCHAR(190) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(190) NOT NULL, active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_portfolio (id INT AUTO_INCREMENT NOT NULL, portfolio_id INT DEFAULT NULL, user_id INT DEFAULT NULL, INDEX IDX_A90D9D86B96B5643 (portfolio_id), INDEX IDX_A90D9D86A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4B96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id)');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A4A7B913DD FOREIGN KEY (ledger_id) REFERENCES ledger (id)');
        $this->addSql('ALTER TABLE user_portfolio ADD CONSTRAINT FK_A90D9D86B96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id)');
        $this->addSql('ALTER TABLE user_portfolio ADD CONSTRAINT FK_A90D9D86A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4A7B913DD');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A4B96B5643');
        $this->addSql('ALTER TABLE user_portfolio DROP FOREIGN KEY FK_A90D9D86B96B5643');
        $this->addSql('ALTER TABLE user_portfolio DROP FOREIGN KEY FK_A90D9D86A76ED395');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE ledger');
        $this->addSql('DROP TABLE portfolio');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_portfolio');
    }
}
