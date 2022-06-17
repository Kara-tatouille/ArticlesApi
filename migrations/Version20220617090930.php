<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220617090930 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('INSERT INTO "user" (id, email, roles, password) VALUES (1, \'test@example.com\', \'[]\', \'$2y$13$cI2O47fxBsw8sJ8ZpuywV.jTL3PFu0YolX7WhZ0oY.pg7ZhFKb6VW\');;');
        $this->addSql('INSERT INTO "user" (id, email, roles, password) VALUES (2, \'jhondoe@example.com\', \'[]\', \'$2y$13$p2m32GWE16Irrkguv4znUOAKSCLcQXiQjpKmNByTrQLq8XWy8Knpy\');');
        $this->addSql('INSERT INTO article (id, title, content, publication_date, status_id, author_id) VALUES (1, \'My well written article\', \'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur arcu lacus, ultricies id dolor efficitur, malesuada vehicula felis. Nulla facilisi. Ut augue lectus, interdum fermentum auctor a, bibendum et dui. Praesent ac mattis augue, at eleifend quam. Ut dignissim tempus nisi at molestie. Praesent luctus commodo nisi, vitae vulputate tellus facilisis vel. Sed hendrerit est arcu, sed feugiat neque placerat at. Vivamus efficitur mauris eleifend neque sollicitudin dapibus.\', \'2022-06-17 09:18:29\', 2, 1);;');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
