<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rich extends Migration
{
	public function up()
	{
		//
        $this->forge->addField([
            'sample_rich_id'          => [ // (2)
                'type'           => 'BIGINT', // (3)
                'unsigned'       => true, // (4)
                'auto_increment' => true, // (5)
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '40', // (6)
            ],
            'age' => [
                'type' => 'INT',
                'null' => true, // (7)
            ],
            'created_at' => [  // (8)
                'type'       => 'VARCHAR',
                'constraint' => '25',  // (9)
            ],
            'updated_at' => [  // (10)
                'type'       => 'VARCHAR',
                'constraint' => '25',
            ],
            'deleted_at' => [  // (11)
                'type'       => 'VARCHAR',
                'constraint' => '25',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('sample_rich_id', true); // (12)
        $this->forge->createTable('sample_rich'); // (13)
	}

	public function down()
	{
		//
        $this->forge->dropTable('sample_rich'); // (14)
	}
}
