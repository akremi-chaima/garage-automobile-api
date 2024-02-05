<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205203419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'option_type table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `option_type` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `name` VARCHAR(45) NOT NULL,
                PRIMARY KEY (`id`)
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `option_type`');
    }
}
