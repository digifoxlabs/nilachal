<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Otp extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'otp_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],                 

            'otp' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
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

            'isexpired' => [
                'type' => 'INT',
                'constraint'=> '32',
            ],          

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('otp_id');
        $this->forge->createTable('otp');
    }

    public function down()
    {
        $this->forge->dropTable('otp');
    }
}
