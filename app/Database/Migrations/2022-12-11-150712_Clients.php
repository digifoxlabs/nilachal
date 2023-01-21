<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clients extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'cl_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],        
            
            'name' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' => true,
                
            ],
   
            'email' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' => true,
                
            ],
            'mobile' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' => true,
            ],        

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('cl_id');
        $this->forge->createTable('clients');
    }

    public function down()
    {
        $this->forge->dropTable('clients');
    }
}
