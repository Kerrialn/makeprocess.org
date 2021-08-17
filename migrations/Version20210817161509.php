<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210817161509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', process_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', content LONGTEXT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', author VARCHAR(255) NOT NULL, INDEX IDX_9474526C7EC2F574 (process_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dependent (id INT AUTO_INCREMENT NOT NULL, content VARCHAR(255) NOT NULL, version DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE process (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', slug BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', title VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, version DOUBLE PRECISION NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_861D1896989D9B62 (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE process_dependent (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', process_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', dependent_id INT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_21D9354C7EC2F574 (process_id), INDEX IDX_21D9354C28414C42 (dependent_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE task (id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid)\', process_id BINARY(16) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', action LONGTEXT NOT NULL, is_complete TINYINT(1) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', duration INT NOT NULL, INDEX IDX_527EDB257EC2F574 (process_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C7EC2F574 FOREIGN KEY (process_id) REFERENCES process (id)');
        $this->addSql('ALTER TABLE process_dependent ADD CONSTRAINT FK_21D9354C7EC2F574 FOREIGN KEY (process_id) REFERENCES process (id)');
        $this->addSql('ALTER TABLE process_dependent ADD CONSTRAINT FK_21D9354C28414C42 FOREIGN KEY (dependent_id) REFERENCES dependent (id)');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB257EC2F574 FOREIGN KEY (process_id) REFERENCES process (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE process_dependent DROP FOREIGN KEY FK_21D9354C28414C42');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C7EC2F574');
        $this->addSql('ALTER TABLE process_dependent DROP FOREIGN KEY FK_21D9354C7EC2F574');
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB257EC2F574');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE dependent');
        $this->addSql('DROP TABLE process');
        $this->addSql('DROP TABLE process_dependent');
        $this->addSql('DROP TABLE task');
    }
}
