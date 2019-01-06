<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190106204158 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE lj_avatar (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', filename VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, alt VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lj_user (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', avatar_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', username VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(150) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', enabled TINYINT(1) NOT NULL, token VARCHAR(191) NOT NULL, user_create DATETIME NOT NULL, UNIQUE INDEX UNIQ_6E81849CF85E0677 (username), UNIQUE INDEX UNIQ_6E81849CE7927C74 (email), UNIQUE INDEX UNIQ_6E81849C5F37A13B (token), UNIQUE INDEX UNIQ_6E81849C86383B10 (avatar_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lj_user ADD CONSTRAINT FK_6E81849C86383B10 FOREIGN KEY (avatar_id) REFERENCES lj_avatar (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lj_user DROP FOREIGN KEY FK_6E81849C86383B10');
        $this->addSql('DROP TABLE lj_avatar');
        $this->addSql('DROP TABLE lj_user');
    }
}
