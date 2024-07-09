<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePemasukanTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pemasukan' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nominal' => [
                'type' => 'INT',
            ],
            'catatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'tgl_pemasukan' => [
                'type' => 'TIMESTAMP',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id_pemasukan', true);
        $this->forge->createTable('pemasukan');
    }

    public function down()
    {
        $this->forge->dropTable('pemasukan');
    }
}
