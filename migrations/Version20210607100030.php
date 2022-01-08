<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210607100030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE forme_legale_fr_fr');
        $this->addSql('DROP TABLE forme_legale_ma_ma');
        $this->addSql('ALTER TABLE fiche_financiere DROP FOREIGN KEY FK_4DCA86C7BD1AC8A5');
        $this->addSql('DROP INDEX IDX_4DCA86C7BD1AC8A5 ON fiche_financiere');
        $this->addSql('ALTER TABLE fiche_financiere DROP ma_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE forme_legale_fr_fr (forme_legale_fr_id INT NOT NULL, fr_id INT NOT NULL, INDEX IDX_115BDF1962177687 (forme_legale_fr_id), INDEX IDX_115BDF19886601C5 (fr_id), PRIMARY KEY(forme_legale_fr_id, fr_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE forme_legale_ma_ma (forme_legale_ma_id INT NOT NULL, ma_id INT NOT NULL, INDEX IDX_436D8E6C576BBFE7 (forme_legale_ma_id), INDEX IDX_436D8E6CBD1AC8A5 (ma_id), PRIMARY KEY(forme_legale_ma_id, ma_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE forme_legale_fr_fr ADD CONSTRAINT FK_115BDF1962177687 FOREIGN KEY (forme_legale_fr_id) REFERENCES forme_legale_fr (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forme_legale_fr_fr ADD CONSTRAINT FK_115BDF19886601C5 FOREIGN KEY (fr_id) REFERENCES fr (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forme_legale_ma_ma ADD CONSTRAINT FK_436D8E6C576BBFE7 FOREIGN KEY (forme_legale_ma_id) REFERENCES forme_legale_ma (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE forme_legale_ma_ma ADD CONSTRAINT FK_436D8E6CBD1AC8A5 FOREIGN KEY (ma_id) REFERENCES ma (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fiche_financiere ADD ma_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche_financiere ADD CONSTRAINT FK_4DCA86C7BD1AC8A5 FOREIGN KEY (ma_id) REFERENCES ma (id)');
        $this->addSql('CREATE INDEX IDX_4DCA86C7BD1AC8A5 ON fiche_financiere (ma_id)');
    }
}
