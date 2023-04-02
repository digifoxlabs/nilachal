<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;
use App\Models\TransactionModel;

class Transactions extends AdminController
{
    public function __construct(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                      
        );
        parent::__construct();
        $this->db = \Config\Database::connect();       

    }

    public function index()
    {
        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
             );  

        //Fetch all Txn
        $model = new TransactionModel();
        $data['transactions'] = $model->orderBY('created_at','desc')->findAll();
       $this-> render_view("Admin/pages/transactions",$data);
    }
}
