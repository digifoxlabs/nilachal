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

        $clientId = (int) session()->get('cl_id');
        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        );      

        $builder = $this->db->table('clients');
        $builder->where('cl_id', $clientId);
        $profileData = $builder->get()->getResultArray();

        foreach($profileData as $profile){

            $data['cl_id'] = $profile['cl_id'];
            $data['name'] = $profile['name'];
            $data['email'] = $profile['email'];
            $data['mobile'] = $profile['mobile'];
        }

        if($this->request->getPost()){

            $postData = [
                'name' => trim((string) $this->request->getPost('name')),
                'email' => trim((string) $this->request->getPost('email')),
                'mobile' => trim((string) $this->request->getPost('mobile')),
            ];

            $rules = [
                'name' => 'required',
                'email' => "required|valid_email|is_unique[clients.email,cl_id,{$clientId}]",
                'mobile' => "required|numeric|is_unique[clients.mobile,cl_id,{$clientId}]",
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
    
            if (!$this->validateData($postData, $rules, $errors)) {
                $data['validation'] = $this->validator;
                $data = array_merge($data, $postData);
                // return view('admin/pages/profile',$data);     
                // $this->render_view('admin/pages/customers/add',$data);   
                $session = session();
                $session->setFlashdata('error', 'Error');
                // return redirect()->to(base_url('profile'));
                $this->render_view('Frontend/pages/profile',$data); 
    
    
            }else {

                $model = new ClientModel();
                $newData = [
                    'cl_id' => $clientId,
                    'name' => $postData['name'],
                    'mobile' => $postData['mobile'],
                    'email' => $postData['email'],
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

    //Terms and conditions
    public function termsConditions(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        $this->render_view('Frontend/pages/terms-conditions',$data); 

    }
    //Refund Policy
    public function refund(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        $this->render_view('Frontend/pages/refund-policy',$data); 

    }
    //Privacy Policy
    public function privacy(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        $this->render_view('Frontend/pages/privacy-policy',$data); 

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
