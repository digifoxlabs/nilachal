<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoomCategory extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'cat_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],         

            'parent_cat_id' => [
                'type' => 'INT',
                'constraint'=> '32',
                'null'=>true,
                'default'=>null,
            ],

            'category' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'occupancy' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'description' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'rate' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],     
        
            'image' => [
                'type' => 'TEXT',
                'null' =>true,  
            ],

            'status' => [
                'type' => 'INT',
                'constraint'=> 32,    
                'default' => 1,
            ],

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('cat_id');
        $this->forge->createTable('room_category');


    }

    public function down()
    {
        $this->forge->dropTable('room_category');
    }
}
