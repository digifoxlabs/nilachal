<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\FrontendController;
// Load Model
use App\Models\ClientModel;

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


    //View Profile
    public  function profile(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        );      

        $builder = $this->db->table('clients');
        $builder->where('cl_id', session()->get('cl_id'));
        $profileData = $builder->get()->getResultArray();

        foreach($profileData as $profile){

            $data['cl_id'] = $profile['cl_id'];
            $data['name'] = $profile['name'];
            $data['email'] = $profile['email'];
            $data['mobile'] = $profile['mobile'];
        }

        if($this->request->getPost()){


            $rules = [
                'name' => 'required|trim',
                'email' => 'required|trim|is_unique[clients.email,cl_id,{row_id}]',
                'mobile' => 'trim|required|numeric|is_unique[clients.mobile,cl_id,{row_id}]',       
            ];
    
            $errors = [
      
                'name' => [
                    'required' => "Name is Required",
                ], 
                'email'=>[
                    'required'=>'Email is required',
                    'is_unique'=>'Duplicate Email',
                ]
               
            ];
    
            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;
                // return view('admin/pages/profile',$data);     
                // $this->render_view('admin/pages/customers/add',$data);   
                $session = session();
                $session->setFlashdata('error', 'Error');
                // return redirect()->to(base_url('profile'));
                $this->render_view('Frontend/pages/profile',$data); 
    
    
            }else {

                $model = new ClientModel();
                $newData = [
                    'cl_id' => $this->request->getVar('row_id'),
                    'name' => $this->request->getVar('name'),
                    'mobile' => $this->request->getVar('mobile'),
                    'email' => $this->request->getVar('email'),               
                ];

                $model->save($newData);
                $session = session();
                $session->setFlashdata('success', 'Operator Updated');
                return redirect()->to(base_url('profile'));

            }


        }

        else {


            $this->render_view('Frontend/pages/profile',$data); 

        }
            


    }

    //About Us
    public function about(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 


        $this->render_view('Frontend/pages/about-us',$data); 

    }


    //Contact
    public function contact(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 


        if($this->request->getPost()){

            $rules = [
                'name' => 'required|trim',
                'email' => 'required|valid_email',
                'phone' => 'trim|required|numeric',       
                'message' => 'trim|required',       
            ];
    
            $errors = [
      
                'name' => [
                    'required' => "Name is Required",
                ], 
                'email'=>[
                    'required'=>'Email is required',
                ],
                'message'=>[
                    'required'=> "Please write your message",
                ],
               
            ];

            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;   
                $this->render_view('Frontend/pages/contact-us',$data); 
    
    
            }else {

                $admin_email = $this->getSettingsvalues('admin_email');

                $dataAdmin = array(
                    'client' => $this->request->getVar('name'),
                    'phone' => $this->request->getVar('phone'),
                    'email' => $this->request->getVar('email'),
                    'message' => $this->request->getVar('message'),
                ); 

                
                $this->sendMessageEmail($admin_email,$dataAdmin);

                $this->render_view('Frontend/pages/contact-us-message',$data); 

            }


        }
        else {

            $this->render_view('Frontend/pages/contact-us',$data); 

        }



    }




    //
    public function sendMessageEmail($address, $data){

        $email = \Config\Services::email(); // loading for use

        $email->setTo($address);

        $email->setSubject("Contact Form - Nilachal");

        // Using a custom template
      //  $data =  array("otp"=> $totp);
        $template = view("admin_contact_email", $data);
        
        $email->setMessage($template);

        // Send email
        if ($email->send()) {
           // echo 'Email successfully sent, please check.';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }


    }





}
