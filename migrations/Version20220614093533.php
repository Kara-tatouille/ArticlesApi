<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use App\Entity\Status;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220614093533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(sprintf("INSERT INTO status (id, name) VALUES (%s, 'Brouillon'), (%s, 'Publié'), (%s, 'Supprimé')",
            Status::DRAFT,
            Status::PUBLISHED,
            Status::DELETED
        ));
    }

    public function down(Schema $schema): void
    {
        $this->addSql(sprintf("DELETE FROM status WHERE id IN (%s, %s, %s)",
            Status::DRAFT,
            Status::PUBLISHED,
            Status::DELETED,
        ));

    }
}
