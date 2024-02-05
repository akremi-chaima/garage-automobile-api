<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205200336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'opening_hours table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `opening_hours` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `day` VARCHAR(10) NOT NULL,
                `morning_start_hour` VARCHAR(5) NULL,
                `morning_end_hour` VARCHAR(5) NULL,
                `afternoon_start_hour` VARCHAR(5) NULL,
                `afternoon_end_hour` VARCHAR(5) NULL,
                PRIMARY KEY (`id`)
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `opening_hours`');
    }
}
