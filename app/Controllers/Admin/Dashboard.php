<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\AdminController;
use App\Models\CategoryModel;

use CodeIgniter\I18n\Time;

class Dashboard extends AdminController
{
    public function __construct(){

        parent::__construct();
        $this->db = db_connect();
    }

    public function index2(){

        //Fetch Rioom category
        $modelCat = new CategoryModel();
        $catData = $modelCat->findAll();

        

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',
            'catData' => $catData,      
            'newBookings' => $this->newBookings(),                                   
            'newCheckIN' => $this->todayCheckIN(),                                   
            'newCheckOut' => $this->todayCheckOut(),                                   
             );  
       $this-> render_view("Admin/pages/dashboard",$data);
    }

    public function index(){

        //Fetch Rioom category
        $modelCat = new CategoryModel();
        $catData = $modelCat->findAll();        

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',
            'catData' => $catData,      
            'newBookings' => $this->newBookings(),                                   
            'newCheckIN' => $this->todayCheckIN(),                                   
            'newCheckOut' => $this->todayCheckOut(),                                   
             );  
       $this-> render_view("Admin/pages/dashboard2",$data);
    }

    //Bed Design Count
    public function noBeds($count){

        $temp = '<i class="fas fa-solid fa-bed"></i>';

        for($i=1; $i<=$count; $i++){

            $temp .=$temp;

        }
        return $temp;
    }

    //cOUNT nEW bOOKINGS
    public function newBookings(){

        //Fetch Booking Data
        $builder = $this->db->table('bookings');
        $builder->where('booking_status', 'confirmed');
        return $builder->countAllResults();
    }

    //Count Todays CheckIN
    public function todayCheckIN(){

        $today = Time::today('Asia/Kolkata', 'en_IN');
        $builder = $this->db->table('bookings');
        $builder->where('check_in', $today);
        $builder->where('checked_in', 1);
        return $builder->countAllResults();

    }

    //Count Todays CheckOut
    public function todayCheckOut(){

        $today = Time::today('Asia/Kolkata', 'en_IN');
        $builder = $this->db->table('bookings');
        $builder->where('check_out', $today);
        return $builder->countAllResults();

    }

    //Settings Page
    public function settings(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                           
        );  


        $data['gst'] = $this->getSettingsvalues('gst');
        $data['discount'] = $this->getSettingsvalues('discount');
        $data['currency'] = $this->getSettingsvalues('currency');
        $data['admin_email'] = $this->getSettingsvalues('admin_email');  
        $data['admin_mobile'] = $this->getSettingsvalues('admin_mobile');  

        //POST Request
        if($this->request->getPost()){

            $update_discount = $this->request->getVar("discount");
            $update_gst = $this->request->getVar("gst");
            $update_currency = $this->request->getVar("currency");
            $update_admin_mobile = $this->request->getVar("admin_mobile");
            $update_admin_email = $this->request->getVar("admin_email");

            $update = array(
                'gst'=>$update_gst,
                'discount'=>$update_discount,
                'currency'=>$update_currency,
                'admin_email'=>$update_admin_email,
                'admin_mobile'=>$update_admin_mobile,
            );

            $update = [
                [
                    'key'  => 'gst',
                    'value' => $update_gst,  
                ],
                [
                    'key'  => 'discount',
                    'value' => $update_discount,  
                ],
                [
                    'key'  => 'currency',
                    'value' => $update_currency,  
                ],
                [
                    'key'  => 'admin_email',
                    'value' => $update_admin_email,  
                ],
                [
                    'key'  => 'admin_mobile',
                    'value' => $update_admin_mobile,  
                ],
        
            ];

            $builder = $this->db->table('settings');
            $builder->updateBatch($update, 'key');


            return redirect()->to(base_url('admin/settings')); 
           // $this-> render_view("Admin/pages/settings",$data);
            
        }

        else {

            $this-> render_view("Admin/pages/settings",$data);
        }

      
    }


}
