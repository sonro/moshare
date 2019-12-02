<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191202183328 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_portfolio MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE user_portfolio DROP FOREIGN KEY FK_A90D9D86A76ED395');
        $this->addSql('ALTER TABLE user_portfolio DROP FOREIGN KEY FK_A90D9D86B96B5643');
        $this->addSql('ALTER TABLE user_portfolio DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE user_portfolio DROP id, CHANGE portfolio_id portfolio_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE user_portfolio ADD CONSTRAINT FK_A90D9D86A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_portfolio ADD CONSTRAINT FK_A90D9D86B96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_portfolio ADD PRIMARY KEY (user_id, portfolio_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_portfolio DROP FOREIGN KEY FK_A90D9D86A76ED395');
        $this->addSql('ALTER TABLE user_portfolio DROP FOREIGN KEY FK_A90D9D86B96B5643');
        $this->addSql('ALTER TABLE user_portfolio ADD id INT AUTO_INCREMENT NOT NULL, CHANGE user_id user_id INT DEFAULT NULL, CHANGE portfolio_id portfolio_id INT DEFAULT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user_portfolio ADD CONSTRAINT FK_A90D9D86A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_portfolio ADD CONSTRAINT FK_A90D9D86B96B5643 FOREIGN KEY (portfolio_id) REFERENCES portfolio (id)');
    }
}
