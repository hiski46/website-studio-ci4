<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMakeupTable extends Migration
{
    public function up()
    {

        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'      => 5,
                'unsigned'      => true,
                'auto_increment' => true
            ],
            'merk' => [
                'type' => 'varchar',
                'constraint' => 100
            ],
            'created_at' => [
                'type' => 'DATETIME'
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('makeup');
    }

    public function down()
    {
        $this->forge->dropTable('makeup', true);
    }
}
