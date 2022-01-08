<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210604105627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, pays VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE forme_legale_fr_fr');
        $this->addSql('DROP TABLE forme_legale_ma_ma');
        $this->addSql('ALTER TABLE adresse ADD region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adresse ADD CONSTRAINT FK_C35F081698260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_C35F081698260155 ON adresse (region_id)');
        $this->addSql('DROP INDEX telephone2 ON contact');
        $this->addSql('DROP INDEX telephone ON contact');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E638450FF010 ON contact (telephone)');
        $this->addSql('DROP INDEX email ON contact');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C62E638E7927C74 ON contact (email)');
        $this->addSql('ALTER TABLE fr ADD forme_legale_fr_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fr ADD CONSTRAINT FK_CC75CECE62177687 FOREIGN KEY (forme_legale_fr_id) REFERENCES forme_legale_fr (id)');
        $this->addSql('CREATE INDEX IDX_CC75CECE62177687 ON fr (forme_legale_fr_id)');
        $this->addSql('ALTER TABLE ma ADD forme_legale_ma_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ma ADD CONSTRAINT FK_AB3F56DB576BBFE7 FOREIGN KEY (forme_legale_ma_id) REFERENCES forme_legale_ma (id)');
        $this->addSql('CREATE INDEX IDX_AB3F56DB576BBFE7 ON ma (forme_legale_ma_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE adresse DROP FOREIGN KEY FK_C35F081698260155');
        $this->addSql('CREATE TABLE forme_legale_fr_fr (forme_legale_fr_id INT NOT NULL, fr_id INT NOT NULL, INDEX IDX_115BDF1962177687 (forme_legale_fr_id), INDEX IDX_115BDF19886601C5 (fr_id), PRIMARY KEY(forme_legale_fr_id, fr_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE forme_legale_ma_ma (forme_legale_ma_id INT NOT NULL, ma_id INT NOT NULL, INDEX IDX_436D8E6C576BBFE7 (forme_legale_ma_id), INDEX IDX_436D8E6CBD1AC8A5 (ma_id), PRIMARY KEY(forme_legale_ma_id, ma_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE forme_legale_fr_fr ADD CONSTRAINT FK_115BDF1962177687 FOREIGN KEY (forme_legale_fr_id) REFERENCES forme_legale_fr (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forme_legale_fr_fr ADD CONSTRAINT FK_115BDF19886601C5 FOREIGN KEY (fr_id) REFERENCES fr (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forme_legale_ma_ma ADD CONSTRAINT FK_436D8E6C576BBFE7 FOREIGN KEY (forme_legale_ma_id) REFERENCES forme_legale_ma (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forme_legale_ma_ma ADD CONSTRAINT FK_436D8E6CBD1AC8A5 FOREIGN KEY (ma_id) REFERENCES ma (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP INDEX IDX_C35F081698260155 ON adresse');
        $this->addSql('ALTER TABLE adresse DROP region_id');
        $this->addSql('CREATE UNIQUE INDEX telephone2 ON contact (telephone2)');
        $this->addSql('DROP INDEX uniq_4c62e638450ff010 ON contact');
        $this->addSql('CREATE UNIQUE INDEX telephone ON contact (telephone)');
        $this->addSql('DROP INDEX uniq_4c62e638e7927c74 ON contact');
        $this->addSql('CREATE UNIQUE INDEX email ON contact (email)');
        $this->addSql('ALTER TABLE fr DROP FOREIGN KEY FK_CC75CECE62177687');
        $this->addSql('DROP INDEX IDX_CC75CECE62177687 ON fr');
        $this->addSql('ALTER TABLE fr DROP forme_legale_fr_id');
        $this->addSql('ALTER TABLE ma DROP FOREIGN KEY FK_AB3F56DB576BBFE7');
        $this->addSql('DROP INDEX IDX_AB3F56DB576BBFE7 ON ma');
        $this->addSql('ALTER TABLE ma DROP forme_legale_ma_id');
    }
}
