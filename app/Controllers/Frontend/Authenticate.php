<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\FrontendController;
use App\Database\Migrations\Otp;
use App\Models\OtpModel;
use App\Models\ClientModel;

class Authenticate extends FrontendController
{
    public function login()
    {
             $data = array( 
                      'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
             );  
             
             
             if ($this->request->getPost()) {

                $rules = [
                    'email' => 'required|trim|valid_email',  
                ];

                $errors = [
                    'email' => [
                        'required' => "Email is Required",
                        'valid_email' => "Enter a valid email",
                    ],
   
                ];

                if (!$this->validate($rules,$errors)) {
                    $data['validation'] = $this->validator; 
                    $this->render_view('Frontend/pages/login',$data);   

                }else {

                   

                    $data1 = array( 
                        'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
                         );  

                  //       $data['pageTitle'] = "HELLO";

                    $email = $this->request->getVar('email');
                    $data1['email'] = $email;

                    //Generate Random Number
                    $tempOTP = random_string('numeric', 6);
      

                    //Save Otp to DB
                    $model = new OtpModel();
                    $data = [
                        'otp'=> $tempOTP,
                        'isexpired' =>1,
                        'email' => $email,

                    ];
                    $model->save($data);


                    //Send Email Otp
                   // $this->sendEmailOtp($email, $tempOTP);

                   $session = session();
                   $session->setTempdata('email-item', $email, 120);
                   
                    
                    //Load OTP Entry Screen
                    $this->render_view('Frontend/pages/otp',$data1); 

                }

             }

             else {

                $this->render_view('Frontend/pages/login',$data); 

             }            
            
    }


    /**Validate OTP */
    public function validateOtp(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
             );  

        if($this->request->getPost()){

            $rules = [
                'email' => 'required|trim|valid_email',  
                'otp' => 'required|trim|numeric'
            ];

            $errors = [
                'email' => [
                    'required' => "Email is Required",
                    'valid_email' => "Enter a valid email",
                ],
                'otp' => [
                    'required' => "Enter OTP",
                    'numeric' => "Enter valid OTP"
                ],

            ];

            if (!$this->validate($rules,$errors)) {

                //Check 120s Temp Session  Data
                $session = session();
                if(!empty($session->getTempdata('email-item'))){

                    $data['email'] = $session->getTempdata('email-item');  
                    $data['pageTitle'] = 'NILACHAL-STAY&TOUR';  
                    $data['validation'] = $this->validator; 
                    $this->render_view('Frontend/pages/otp',$data);   

                }            

            }
            else {


                /**1. Check OTP */

                $client_email = $this->request->getVar('email');
                $client_entered_otp = $this->request->getVar('otp');

               $check =  $this->verifyOtp($client_entered_otp, $client_email);
               if($check){ 
                
                /**
                 * Login Success
                 * Check for Guest Profile and IF Empty Create profile
                 */
               $clientLog = $this->setClientSession($client_email);
               if($clientLog){

                 return redirect()->to(base_url('/bookings'));
               }
            
                }
               else {

                //Login Fail

                                //Check 120s Temp Session  Data
                                $session = session();
                                if(!empty($session->getTempdata('email-item'))){
                
                                    $data['email'] = $session->getTempdata('email-item');  
                                    $data['pageTitle'] = 'NILACHAL-STAY&TOUR';  
                                    $data['validation'] = $this->validator; 
                                    $this->render_view('Frontend/pages/otp',$data);   
                
                                }  


               }        

               // echo $this->request->getVar('otp');
            }


        }

        else {

            return redirect()->to(base_url('/login'));
        }

    }



    public function sendEmailOtp($address, $totp){

        $email = \Config\Services::email(); // loading for use

        $email->setTo($address);

        $email->setSubject("Login OTP - Nilachal");

        // Using a custom template
        $data =  array("otp"=> $totp);
        $template = view("otp-template", $data);
        
        $email->setMessage($template);

        // Send email
        if ($email->send()) {
            echo 'Email successfully sent, please check.';
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }


    }

    //Verify OTP
    public function verifyOtp($passcode, $email=null){


        $model = new otpModel();
        $user = $model->where('otp',$passcode)
                        ->where('email',$email)
                        ->where('isexpired', 1)
                        ->where('DATE_ADD(created_at, INTERVAL 2 MINUTE) >=', now())
                        ->first();

        if (!$user)
            return false;

        return true;
        // $builder = $this->db->table("otp");
		// $builder->select('otp');
        // $builder->where('email',$email);
		// return $builder->get()->getRow()->value;  


    }


    private function setClientSession($setEmail)
    {

        //Check for User Profile
        $builder = $this->db->table("clients");
        $builder->select('email');
        $builder->where('email',$setEmail);

        if($builder->get()->getNumRows() > 0){

            //Get Data
            $userData = $builder->get()->getRow();
            if(isset($userData)){

                  //  echo $userData->email;

                    $data = [
                        'cl_id' => $userData->cl_id,
                        'name' => $userData->name,
                        'mobile' => $userData->mobile,
                        'email' => $userData->email,
                        'user_type' => 'client',
                        'isLoggedInClient' => true,
                    ];

            }
        }

        else {

            //insert ne record
            $dataInsert = [
                'name'  => 'Guest',
                'email'  => $setEmail,
                'mobile'  => null,
            ];
            
            $builder->insert($dataInsert);

            $data = [
                'cl_id' => $this->db->insertID(),
                'name' => 'Guest',
                'mobile' => null,
                'email' => $setEmail,
                'user_type' => 'client',
                'isLoggedInClient' => true,
            ];

        }
        //return $builder->get()->getRow()->value;


        session()->set($data);
        return true;
    }



    public function logout()
    {
        session()->destroy();
        // return redirect()->to('admin/login');
        return redirect()->to(base_url('/login'));
    }






}
