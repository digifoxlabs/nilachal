<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bookings extends Migration
{
    public function up()
    {
        $this->forge->addField([

            'bk_id' => [
                'type' => 'INT',
                'constraint'     => 32,
                'auto_increment'=>true,
            ],        
            
            'booking_code' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],  
   
            'mode' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                
            ],
            'guest_name' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],        
            'guest_mobile' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],        
            'guest_email' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null' => true
            ],        
            'guest_address' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null'=>true,
            ],        
            'identity' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null'=>true,
            ],        
            'identity_no' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'null'=>true,
            ],        
            'check_in' => [
                'type' => 'DATE',
            ],        
            'check_out' => [
                'type' => 'DATE',
            ],    
            'booking_amt' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],   
            'sgst' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],   
            'cgst' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],   
            'discount' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],   
            'total_amt' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],   
            'amt_paid' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],   
            'balance_amt' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],   
            'booking_status' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
                'default' => 'pending'
            ],   
            'payment_status' => [
                'type' => 'VARCHAR',
                'constraint'=> '256',
            ],   
            'checked_in' => [
                'type' => 'VARCHAR',
                'constraint'=> '32',
                'default' => 1,
            ],   
            'room_assigned' => [
                'type' => 'VARCHAR',
                'constraint'=> '32',
                'default' => 1,
            ],   
            'checked_out' => [
                'type' => 'VARCHAR',
                'constraint'=> '32',
                'default' => 1,
            ],   
            'no_guests' => [
                'type' => 'VARCHAR',
                'constraint'=> '32',
            ],   
            'client_id' => [
                'type' => 'VARCHAR',
                'constraint'=> '32',
                'null' => true
            ],   
            'user_id' => [
                'type' => 'VARCHAR',
                'constraint'=> '32',
                'null' => true
            ],   

            'created_at datetime default current_timestamp',
            'updated_at datetime default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addPrimaryKey('bk_id');
        $this->forge->createTable('bookings');
    }

    public function down()
    {
        $this->forge->dropTable('bookings');
    }
}
