<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240205211847 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'feedback status table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('
            CREATE TABLE `status` (
                `id` int(11) NOT NULL,
                `name` varchar(45) NOT NULL,
                `code` varchar(45) NOT NULL,
                PRIMARY KEY (`id`)
            )
        ');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE `status`');
    }
}
