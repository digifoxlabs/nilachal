<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUnavailableDateRangeTable extends Migration
{
    public function up()
    {
              // Create table for single dates and date ranges
              $this->forge->addField([
                'date_id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'auto_increment' => true,
                ],
                'disable_category' => [
                    'type' => 'VARCHAR',
                    'constraint'=> '256',
                    'default' => 'online', //online or offline
                    
                ],
                'date_type' => [
                    'type' => 'ENUM',
                    'constraint' => ['single', 'range'],
                    'default' => 'single',
                ],
                'single_date' => [
                    'type' => 'DATE',
                    'null' => true, // Allow NULL since single_date can be NULL when a range is present
                ],
                'start_date' => [
                    'type' => 'DATE',
                    'null' => true, // Allow NULL for start_date if it's a single date
                ],
                'end_date' => [
                    'type' => 'DATE',
                    'null' => true, // Allow NULL for end_date if it's a single date
                ],
                'description' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true, // Allow NULL for description
                ],
                'created_at datetime default current_timestamp',
                'updated_at datetime default current_timestamp on update current_timestamp',
            ]);
    
            // Add primary key
            $this->forge->addPrimaryKey('date_id');
            
            // Create the table
            $this->forge->createTable('disable_date_ranges');
    }

    public function down()
    {
          // Drop the table if rolling back
          $this->forge->dropTable('disable_date_ranges');
    }
}
