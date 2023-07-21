<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

use function PHPSTORM_META\type;

class Visitors extends Migration
{
    public function up()
    {
        $this->forge->dropTable('visitor', true);
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'      => 5,
                'unsigned'      => true,
                'auto_increment' => true
            ],
            'ip' => [
                'type' => 'varchar',
                'constraint'   => 20,
            ],
            'date' => [
                'type' => 'date'
            ],
            'hits' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'online' => [
                'type' => 'varchar',
                'constraint'   => 25,
            ],
            'time' => [
                'type' => 'datetime'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('visitor');
    }

    public function down()
    {
        //
    }
}
