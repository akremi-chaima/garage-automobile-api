<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205194838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `user` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `firstname` VARCHAR(60) NOT NULL,
                `lastname` VARCHAR(60) NOT NULL,
                `email` VARCHAR(60) NOT NULL,
                `password` VARCHAR(200) NOT NULL,
                `role` VARCHAR(16) NOT NULL,
                `active` TINYINT NOT NULL DEFAULT 1,
            PRIMARY KEY (`id`))
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `user`');
    }
}
