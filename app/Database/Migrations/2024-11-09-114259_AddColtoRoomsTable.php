<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddColtoRoomsTable extends Migration
{
    public function up()
    {
        $fields = [
            'is_online' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 1,
                'after' => 'booking_code',  // Place after this column
            ],
            'is_offline' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
                'default' => 1,
                'after' => 'is_online',  // Place after is_online
            ],
        ];

        $this->forge->addColumn('rooms', $fields);
    }

    public function down()
    {
          // Drop columns in case of rollback
          $this->forge->dropColumn('rooms', 'is_online');
          $this->forge->dropColumn('rooms', 'is_online');
    }
}
