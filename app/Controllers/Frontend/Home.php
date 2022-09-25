<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\FrontendController;

class Home extends FrontendController
{
    public function __construct(){

        parent::__construct();

        $this->db = db_connect();

    }

    public function index(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
             );      
            
            $this->render_view('Frontend/pages/home',$data); 
    }


}
