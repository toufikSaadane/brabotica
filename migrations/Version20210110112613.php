<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210110112613 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, billing_email VARCHAR(255) NOT NULL, billing_name VARCHAR(255) NOT NULL, billing_adress VARCHAR(255) NOT NULL, billing_postalcode VARCHAR(255) NOT NULL, billing_total DOUBLE PRECISION NOT NULL, shipped TINYINT(1) NOT NULL, payment_method VARCHAR(255) NOT NULL, payment_gateway VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_F52993989D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993989D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE product ADD order_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04ADFCDAEAAA FOREIGN KEY (order_id_id) REFERENCES `order` (id)');
        $this->addSql('CREATE INDEX IDX_D34A04ADFCDAEAAA ON product (order_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04ADFCDAEAAA');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP INDEX IDX_D34A04ADFCDAEAAA ON product');
        $this->addSql('ALTER TABLE product DROP order_id_id');
    }
}
