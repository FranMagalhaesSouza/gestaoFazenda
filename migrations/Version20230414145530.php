<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230414145530 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consumo_racao (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, qtd_racao DOUBLE PRECISION NOT NULL, dt_inicial DATE NOT NULL, dt_final DATE NOT NULL, INDEX IDX_6359458F8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE producao_leite (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, qntd_leite DOUBLE PRECISION NOT NULL, dt_inicial DATE NOT NULL, dt_final DATE NOT NULL, INDEX IDX_D3E984CF8E962C16 (animal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consumo_racao ADD CONSTRAINT FK_6359458F8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE producao_leite ADD CONSTRAINT FK_D3E984CF8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE consumo_racao DROP FOREIGN KEY FK_6359458F8E962C16');
        $this->addSql('ALTER TABLE producao_leite DROP FOREIGN KEY FK_D3E984CF8E962C16');
        $this->addSql('DROP TABLE consumo_racao');
        $this->addSql('DROP TABLE producao_leite');
    }
}
