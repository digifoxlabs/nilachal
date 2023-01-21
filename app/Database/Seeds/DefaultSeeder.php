<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DefaultSeeder extends Seeder
{
    public function run()
    {
        
        //Default User 
        $data = [
            'password' => password_hash("password", PASSWORD_DEFAULT),
            'name' => 'ADMIN',
            'mobile' => '9999999999',
            'email'    => 'admin@gmail.com',
            'gender'    => 'male',
            'dob' => '2022-01-01',
            'address' => NULL,
            'district' => NULL,
            'user_type' => 'admin',
            'created_by' => 1,
            'status' => 1,

        ];       
        
        $u_id= $this->db->table('users')->insert($data);

        //Admin permissions
        $gdata = [
                
                 'group_name' => 'superadmin',
                'permissions' => 'a:4:{i:0;s:9:"createAll";i:1;s:7:"viewAll";i:2;s:9:"updateAll";i:3;s:9:"deleteAll";}',             
    
        ];        
        $g_id = $this->db->table('groups')->insert($gdata);


        //Map Default user-group
        $ugdata = [
            'u_id'=> $u_id,
            'g_id' => $g_id,
        ];
        $this->db->table('user_group')->insert($ugdata);



        //Default Site Title
        $sdata = [
            [
                'key'=> 'site_title',
                'value' => 'MY APP',
            ],
            [
                'key'=> 'site_footer',
                'value' => 'Copyright © 2023',

            ] ,                  
            [
                'key'=> 'gst',
                'value' => '18',

            ] ,                  
            [
                'key'=> 'discount',
                'value' => '500',

            ] ,                  
            [
                'key'=> 'currency',
                'value' => 'Rs.',

            ] ,                  
            [
                'key'=> 'admin_email',
                'value' => 'support@nilachalstay.com',

            ] ,                  
            [
                'key'=> 'admin_mobile',
                'value' => '6026500977',

            ] ,                  
        ];
        $this->db->table('settings')->insertbatch($sdata);



        //Default Room category
        $roomdata = [
            [ 
                'category'=>'Deluxe',
                'occupancy'=> '2',
                'description'=> 'This is a Deluxe room with double occupancy',
                'rate'=> '2500',
                'status'=> 1,              
            ],
            [ 
                'category'=>'Semi-Deluxe',
                'occupancy'=> '2',
                'description'=> 'This is a Semi-Deluxe room with triple occupancy',
                'rate'=> '2300',
                'status'=> 1,              
            ],
            [ 
                'category'=>'Super-Deluxe',
                'occupancy'=> '2',
                'description'=> 'This is a Super-Deluxe room wth quad occupancy',
                'rate'=> '3500',
                'status'=> 1,              
            ],
        ];
        $this->db->table('room_category')->insertbatch($roomdata);



    }
}
