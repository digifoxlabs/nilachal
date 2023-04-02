<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateAndAddfieldToRoomsTable extends Migration
{
    public function up()
    {
        
        ## Add TV package Expiry column
        $addfields = [
        'tv_package_expiry' => [
                'type' => 'DATE',
        ],
    ];
    $this->forge->addColumn('rooms', $addfields);

    }

    public function down()
    {
        //
    }
}
