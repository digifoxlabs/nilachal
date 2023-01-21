<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Rooms extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'room_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],         
            'cat_id' => [
                'type' => 'INT',
                'constraint'     => 32,
              
            ],         

            'room_no' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'status' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'booking_code' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],            

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('room_id');
        $this->forge->createTable('rooms');
    }

    public function down()
    {
        $this->forge->dropTable('rooms');
    }
}
