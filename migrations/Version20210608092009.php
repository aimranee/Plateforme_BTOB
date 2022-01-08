<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608092009 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fr_categorie (fr_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_FD9FFBEA886601C5 (fr_id), INDEX IDX_FD9FFBEABCF5E72D (categorie_id), PRIMARY KEY(fr_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ma_categorie (ma_id INT NOT NULL, categorie_id INT NOT NULL, INDEX IDX_BB19FD2EBD1AC8A5 (ma_id), INDEX IDX_BB19FD2EBCF5E72D (categorie_id), PRIMARY KEY(ma_id, categorie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region_adresse (region_id INT NOT NULL, adresse_id INT NOT NULL, INDEX IDX_D84D799198260155 (region_id), INDEX IDX_D84D79914DE7DC5C (adresse_id), PRIMARY KEY(region_id, adresse_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fr_categorie ADD CONSTRAINT FK_FD9FFBEA886601C5 FOREIGN KEY (fr_id) REFERENCES fr (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE fr_categorie ADD CONSTRAINT FK_FD9FFBEABCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ma_categorie ADD CONSTRAINT FK_BB19FD2EBD1AC8A5 FOREIGN KEY (ma_id) REFERENCES ma (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ma_categorie ADD CONSTRAINT FK_BB19FD2EBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE region_adresse ADD CONSTRAINT FK_D84D799198260155 FOREIGN KEY (region_id) REFERENCES region (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE region_adresse ADD CONSTRAINT FK_D84D79914DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE forme_legale_fr_fr');
        $this->addSql('DROP TABLE forme_legale_ma_ma');
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
        $this->addSql('DROP TABLE fr_categorie');
        $this->addSql('DROP TABLE ma_categorie');
        $this->addSql('DROP TABLE region_adresse');
    }
}
