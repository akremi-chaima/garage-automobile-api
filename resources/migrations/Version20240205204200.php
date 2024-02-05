<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205204200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `vehicle` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `price` DECIMAL(10,2) NOT NULL,
                `circulation_date` DATE NOT NULL,
                `mileage` INT NOT NULL,
                `fiscal_power` INT NOT NULL,
                `manufacturing_year` INT NOT NULL,
                `active` TINYINT NOT NULL DEFAULT 1,
                `color_id` INT NOT NULL,
                `model_id` INT NOT NULL,
                `energy_id` INT NOT NULL,
                `gearbox_id` INT NOT NULL,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`color_id`)
                REFERENCES `color` (`id`),
                FOREIGN KEY (`model_id`)
                REFERENCES `model` (`id`),
                FOREIGN KEY (`energy_id`)
                REFERENCES `energy` (`id`),
                FOREIGN KEY (`gearbox_id`)
                REFERENCES `gearbox` (`id`)
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `vehicle`');
    }
}
