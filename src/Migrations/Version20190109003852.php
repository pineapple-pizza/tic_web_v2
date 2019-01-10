<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190109003852 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE traduction_source (id INT AUTO_INCREMENT NOT NULL, project_id_id INT NOT NULL, source VARCHAR(255) NOT NULL, INDEX IDX_E51D4946C1197C9 (project_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lang_code (id INT AUTO_INCREMENT NOT NULL, lang_code VARCHAR(5) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traduction_target (id INT AUTO_INCREMENT NOT NULL, lang_code_id INT NOT NULL, traduction_source_id INT NOT NULL, target VARCHAR(255) NOT NULL, INDEX IDX_17B4841B64BB6B3 (lang_code_id), INDEX IDX_17B4841B6563B46B (traduction_source_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id INT AUTO_INCREMENT NOT NULL, user_id_id INT NOT NULL, lang_code_id INT NOT NULL, name VARCHAR(40) NOT NULL, file VARCHAR(255) NOT NULL, INDEX IDX_2FB3D0EE9D86650F (user_id_id), INDEX IDX_2FB3D0EE64BB6B3 (lang_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lang_has_user (id INT AUTO_INCREMENT NOT NULL, lang_code_id INT NOT NULL, user_id_id INT NOT NULL, INDEX IDX_155FBAF64BB6B3 (lang_code_id), INDEX IDX_155FBAF9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE traduction_source ADD CONSTRAINT FK_E51D4946C1197C9 FOREIGN KEY (project_id_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE traduction_target ADD CONSTRAINT FK_17B4841B64BB6B3 FOREIGN KEY (lang_code_id) REFERENCES lang_code (id)');
        $this->addSql('ALTER TABLE traduction_target ADD CONSTRAINT FK_17B4841B6563B46B FOREIGN KEY (traduction_source_id) REFERENCES traduction_source (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE64BB6B3 FOREIGN KEY (lang_code_id) REFERENCES lang_code (id)');
        $this->addSql('ALTER TABLE lang_has_user ADD CONSTRAINT FK_155FBAF64BB6B3 FOREIGN KEY (lang_code_id) REFERENCES lang_code (id)');
        $this->addSql('ALTER TABLE lang_has_user ADD CONSTRAINT FK_155FBAF9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE traduction_target DROP FOREIGN KEY FK_17B4841B6563B46B');
        $this->addSql('ALTER TABLE traduction_target DROP FOREIGN KEY FK_17B4841B64BB6B3');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE64BB6B3');
        $this->addSql('ALTER TABLE lang_has_user DROP FOREIGN KEY FK_155FBAF64BB6B3');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE9D86650F');
        $this->addSql('ALTER TABLE lang_has_user DROP FOREIGN KEY FK_155FBAF9D86650F');
        $this->addSql('ALTER TABLE traduction_source DROP FOREIGN KEY FK_E51D4946C1197C9');
        $this->addSql('DROP TABLE traduction_source');
        $this->addSql('DROP TABLE lang_code');
        $this->addSql('DROP TABLE traduction_target');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE lang_has_user');
    }
}
