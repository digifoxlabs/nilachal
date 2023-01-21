<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sessions extends Migration
{
    public function up()
    {
        $this->forge->addField([

            's_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],                 

            'booking_code' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],
            'room_cat' => [
                'type' => 'INT',
                'constraint'=> '32',                    
            ],
            'room_selected' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' => true,
            ],

        ]);

        $this->forge->addPrimaryKey('s_id');
        $this->forge->createTable('sessions');
    }

    public function down()
    {
        $this->forge->dropTable('sessions');
    }
}
