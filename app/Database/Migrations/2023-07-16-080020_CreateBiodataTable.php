<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBiodataTable extends Migration
{
    public function up()
    {
        $this->forge->dropTable('biodata', true);
        $this->forge->addField([
            'biodata' => [
                'type' => 'varchar',
                'constraint'   => 100,
            ],
            'value' => [
                'type' => 'text'
            ],
        ]);
        $this->forge->addKey('biodata', true);
        $this->forge->createTable('biodata');
    }

    public function down()
    {
        $this->forge->dropTable('biodata', true);
    }
}
