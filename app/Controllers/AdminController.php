<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class AdminController extends BaseController
{
   

    var $permission = array();

	public function __construct() 
	{
		$this->db = db_connect(); // Loading database

        $group_data = array();
		if(empty(session()->get('isLoggedIn'))) {
			$session_data = array('isLoggedIn' => FALSE);
            session()->set($session_data);
		}
		else {
			$user_id = session()->get('id');
			$group_data = $this->getUserGroupByUserId($user_id);			
            if(isset($group_data['permissions'])){
               $permission['user_permission'] = unserialize($group_data['permissions']);
               $this->permission = unserialize($group_data['permissions']);   
            }        
		}	
	}

    public function getUserGroupByUserId($user_id) 
	{
        $builder = $this->db->table("user_group");
        $builder->select('user_group.u_id,user_group.g_id, groups.group_name, groups.permissions');
        $builder->join('groups', 'user_group.ug_id = groups.g_id');
        $builder->where('user_group.u_id',$user_id);
        return $builder->get()->getRowArray();
	}


    public function getSettingsvalues($key){
        $builder = $this->db->table("settings");
		$builder->select('value');
        $builder->where('key',$key);
		return $builder->get()->getRow()->value;  
    }


    public function render_view($page = null, $data = array())
    {
        $defaultData = array( 
            'siteTitle' => $this->getSettingsvalues('site_title'),
            'footerTitle' => $this->getSettingsvalues('site_footer')
        );


         echo view('Admin/template/master/header',$data)
                . view('Admin/template/master/sidebar',$defaultData)
                . view('Admin/template/master/topbar',$defaultData)
                . view($page,$data)
                . view('Admin/template/master/footer',$defaultData);
    }


    //No of Nights
    public function getNoNights($start,$end){

        if($start==$end){
            return 1;           
        }

        else {

            return ($end-$start)/86400;
        }
    }

    //Get Guest Details By Booking ID
    public function getGuestDetailsById($bkCode,$colName){
        $builder = $this->db->table("bookings");
		$builder->select($colName);
        $builder->where('booking_code',$bkCode);
		return $builder->get()->getRow()->$colName;  
    }

}
