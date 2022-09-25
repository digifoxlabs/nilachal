<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class FrontendController extends BaseController
{
    
	public function __construct() 
	{
		$this->db = db_connect(); // Loading database
	
	}


    
    public function render_view($page = null, $data = array())
    {
        $defaultData = array( 
            'siteTitle' => $this->getSettingsvalues('site_title'),
            'footerTitle' => $this->getSettingsvalues('site_footer')
        );


         echo view('Frontend/template/header',$data)
                . view('Frontend/template/nav',$data)              
                . view($page,$data)
                . view('Frontend/template/footer',$defaultData);
    }

    public function getSettingsvalues($key){
        $builder = $this->db->table("settings");
		$builder->select('value');
        $builder->where('key',$key);
		return $builder->get()->getRow()->value;  
    }




}
