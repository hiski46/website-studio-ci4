<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTransaksiTable extends Migration
{
    public function up()
    {
        $this->forge->dropTable('transaksi', true);
        $this->forge->addField([
            'id' => [
                'type'          => 'INT',
                'constraint'      => 5,
                'unsigned'      => true,
                'auto_increment' => true
            ],
            'kode_transaksi' => [
                'type'  => 'varchar',
                'constraint'      => 20,
                'unique'    => true
            ],
            'nama' => [
                'type'  => 'varchar',
                'constraint'      => 100,
            ],
            'email' => [
                'type'  => 'varchar',
                'constraint'      => 100,
            ],
            'telepon' => [
                'type'  => 'varchar',
                'constraint'      => 100,
            ],
            'paket' => [
                'type' => 'json',
            ],
            'is_paid' => [
                'type' => 'boolean',
                'default' => '0',
            ],
            'paid_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'paid_by' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true
            ],
            'paid_phone' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true
            ],
            'paid_email' => [
                'type' => 'varchar',
                'constraint' => 100,
                'null' => true
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
        $this->forge->createTable('transaksi');
    }

    public function down()
    {
        $this->forge->dropTable('transaksi', true);
    }
}
