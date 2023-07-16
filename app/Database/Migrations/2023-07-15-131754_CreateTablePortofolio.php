<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTablePortofolio extends Migration
{
    public function up()
    {
        $this->forge->dropTable('portofolio', true);
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'      => 5,
                'unsigned'      => true,
                'auto_increment' => true
            ],
            'portofolio' => [
                'type' => 'json',
            ],
            'is_active' => [
                'type' => 'boolean',
                'default' => '0',
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
        $this->forge->createTable('portofolio');
    }

    public function down()
    {
        $this->forge->dropTable('portofolio', true);
    }
}
