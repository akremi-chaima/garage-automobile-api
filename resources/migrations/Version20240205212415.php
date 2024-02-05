<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205212415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'feedback table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `feedback` (
                `id` INT NOT NULL AUTO_INCREMENT,
                `firstname` varchar(60) NOT NULL,
                `lastname` varchar(60) NOT NULL,
                `message` longtext NOT NULL,
                `stars` int(11) NOT NULL,
                `created_at` datetime NOT NULL,
                `status_id` INT NOT NULL,
                PRIMARY KEY (`id`),
                FOREIGN KEY (`status_id`)
                REFERENCES `status` (`id`)
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `feedback`');
    }
}
