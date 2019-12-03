<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191203163516 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, from_transactor_id INT DEFAULT NULL, to_transactor_id INT DEFAULT NULL, ledger_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, title VARCHAR(64) NOT NULL, description LONGTEXT NOT NULL, value INT NOT NULL, split_evenly TINYINT(1) NOT NULL, INDEX IDX_723705D116BEE164 (from_transactor_id), INDEX IDX_723705D1D05BEBAF (to_transactor_id), INDEX IDX_723705D1A7B913DD (ledger_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transaction_liable_account (transaction_id INT NOT NULL, account_id INT NOT NULL, INDEX IDX_678DF8D12FC0CB0F (transaction_id), INDEX IDX_678DF8D19B6B5FBA (account_id), PRIMARY KEY(transaction_id, account_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transactor (id INT AUTO_INCREMENT NOT NULL, account_id INT DEFAULT NULL, external TINYINT(1) NOT NULL, name VARCHAR(64) DEFAULT NULL, INDEX IDX_A54EFD19B6B5FBA (account_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D116BEE164 FOREIGN KEY (from_transactor_id) REFERENCES transactor (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1D05BEBAF FOREIGN KEY (to_transactor_id) REFERENCES transactor (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1A7B913DD FOREIGN KEY (ledger_id) REFERENCES ledger (id)');
        $this->addSql('ALTER TABLE transaction_liable_account ADD CONSTRAINT FK_678DF8D12FC0CB0F FOREIGN KEY (transaction_id) REFERENCES transaction (id)');
        $this->addSql('ALTER TABLE transaction_liable_account ADD CONSTRAINT FK_678DF8D19B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE transactor ADD CONSTRAINT FK_A54EFD19B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE transaction_liable_account DROP FOREIGN KEY FK_678DF8D12FC0CB0F');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D116BEE164');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1D05BEBAF');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE transaction_liable_account');
        $this->addSql('DROP TABLE transactor');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
    }
}
