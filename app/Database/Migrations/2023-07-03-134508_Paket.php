<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Paket extends Migration
{
    public function up()
    {
        $this->forge->dropTable('paket_category', true);
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'      => 5,
                'unsigned'      => true,
                'auto_increment' => true
            ],
            'category' => [
                'type'  => 'VARCHAR',
                'constraint' => 100,
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('paket_category');
        $this->forge->dropTable('paket', true);
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'      => 5,
                'unsigned'      => true,
                'auto_increment' => true
            ],
            'category_id' => [
                'type'  => 'INT',
                'constraint'      => 5,
                'unsigned'      => true,
            ],
            'title' => [
                'type'          => 'VARCHAR',
                'constraint'      => 100
            ],
            'price' => [
                'type'      => 'INT'
            ],
            'price_disc' => [
                'type'  => 'INT',
                'null'  => true
            ],
            'description' => [
                'type' => 'TEXT'
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint'      => 100,
                'null' => true
            ],
            'is_active' => [
                'type' => 'boolean',
                'default' => 1
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
        $this->forge->addForeignKey('category_id', 'paket_category', 'id');
        $this->forge->createTable('paket');
    }

    public function down()
    {
        $this->forge->dropTable('paket');
        $this->forge->dropTable('paket_category');
    }
}
