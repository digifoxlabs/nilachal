<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\AdminController;

class Dashboard extends AdminController
{
    public function __construct(){

        parent::__construct();
        $this->db = db_connect();
    }

    public function index(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN'                                         
             );  
       $this-> render_view("Admin/Pages/dashboard");
    }

}
