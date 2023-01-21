<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoomReservation extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'rs_id' => [
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

            'no_rooms' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'check_in' => [
                'type' => 'DATE',
            ],        
            'check_out' => [
                'type' => 'DATE',
            ], 

            'no_nights' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ], 

            'rate' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],     
        
            'room_assigned' => [
                'type' => 'TEXT',
                'null' =>true,  
            ],       

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('rs_id');
        $this->forge->createTable('room_reservation');
    }

    public function down()
    {
        $this->forge->dropTable('room-reservation');
    }
}
