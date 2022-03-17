<?php
// 파일생성 php spark migrate:create
// 파일 실행 php spark migrate

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddClient extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
                'unique' => true
            ],
            'retainer_fee' => [
                'type' => 'INT',
                'constraint' => 100,
                'null' => false,
                'unique' => true,
            ],
            'updated_at' => [
                'type' => 'datetime',
                'null' => true,
            ],
            'created_at datetime default current_timestamp',
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('tb_client');
    }

    public function down()
    {
        $this->forge->dropTable('tb_client');
    }
}
