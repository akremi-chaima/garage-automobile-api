<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205203746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `options` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(60) NOT NULL,
                `option_type_id` INT NOT NULL,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`option_type_id`)
                REFERENCES `option_type` (`id`)
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `options`');
    }
}
