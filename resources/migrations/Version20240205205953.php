<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205205953 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `vehicle_options` (
                `vehicle_id` INT NOT NULL,
                `options_id` INT NOT NULL,
                PRIMARY KEY (`vehicle_id`, `options_id`),
                FOREIGN KEY (`vehicle_id`)
                REFERENCES `vehicle` (`id`),
                FOREIGN KEY (`options_id`)
                REFERENCES `options` (`id`)
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `vehicle_options`');
    }
}
