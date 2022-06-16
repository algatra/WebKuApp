<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                'type' => 'INT',
                'auto_increment' => TRUE,
                'constraint' => 11
            ],
            "username" => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            "password" => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            "nama" => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            "alamat" => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            "tempat_lahir" => [
                'type' => 'TEXT'
            ],
            "tanggal_lahir" => [
                'type' => 'DATE'
            ],
            "gender" => [
                'type' => 'ENUM',
                'constraint' => ['laki-laki', 'perempuan', '']
            ],
            "telepon" => [
                'type' => 'VARCHAR',
                'constraint' => 20
            ],
            "email" => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            "avatar" => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            "created_at" => [
                'type' => 'DATETIME',
                'null' => TRUE
            ],
            "updated_at" => [
                'type' => 'DATETIME',
                'null' => TRUE
            ]
        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('user');
    }

    public function down()
    {
        $this->forge->dropTable('user');
    }
}
