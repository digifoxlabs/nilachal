<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'tx_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],         
            'transaction_id' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
              
            ],         

            'key' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null'=> true,
            ],

            'amount' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],

            'name' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],      
                  
            'email' => [
                'type' => 'TEXT',
                'null'=> true,
            ],            

            'phone' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],            

            'product_info' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null'=> true,
            ],    

            'surl' => [
                'type' => 'TEXT',
                'null'=> true,
            ],     

            'furl' => [
                'type' => 'TEXT',
                'null'=> true,
            ],            
            'hash' => [
                'type' => 'TEXT',
                'null'=> true,
            ],            

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('tx_id');
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}
