<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Packages extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'package_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],                 

            'package' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],
            'validity' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' => true,
                
            ],
            'amount' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' => true,
            ],
      

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('package_id');
        $this->forge->createTable('packages');

    }

    public function down()
    {
        $this->forge->dropTable('packages');
    }
}
