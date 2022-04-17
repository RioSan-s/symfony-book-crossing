<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220415190344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Создание связи между книгами и статусами';
    }

    public function up(Schema $schema): void
    {
       $sql=
           <<<EOF
alter table books add column status_id int constraint book_status_id_fk references status(id)

EOF;
$this->addSql($sql);

    }

    public function down(Schema $schema): void
    {
        $this->addSql('alter table books drop constraint book_status_id_fk');
        $this->addSql('alter table books drop column status_id');


    }
}
