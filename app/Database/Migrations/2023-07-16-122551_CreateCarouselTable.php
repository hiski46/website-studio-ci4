<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCarouselTable extends Migration
{
    public function up()
    {
        $this->forge->dropTable('carousel', true);
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'      => 5,
                'unsigned'      => true,
                'auto_increment' => true
            ],
            'img' => [
                'type' => 'varchar',
                'constraint'   => 100,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('carousel');
    }

    public function down()
    {
        $this->forge->dropTable('carousel');
    }
}
