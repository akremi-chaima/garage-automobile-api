<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205200059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'service table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `service` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(100) NOT NULL,
                `active` TINYINT NOT NULL DEFAULT 1,
                PRIMARY KEY (`id`)
            )
        ');

    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `service`');
    }
}
