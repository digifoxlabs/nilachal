<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\FrontendController;

class Payment extends AdminController
{

    /**Initiate Payment */
    public function index()
    {
        
        $status = $this->input->post('status');
        if (empty($status)) {
              redirect('Welcome');
          }
         
          $firstname = $this->input->post('firstname');
          $amount = $this->input->post('amount');
          $txnid = $this->input->post('txnid');
          $posted_hash = $this->input->post('hash');
          $key = $this->input->post('key');
          $productinfo = $this->input->post('productinfo');
          $email = $this->input->post('email');
          $salt = "UUvOK5cWac8GqrlmSM5uxUcBHuCM5dCR"; //  Your salt
          $add = $this->input->post('additionalCharges');
          If (isset($add)) {
              $additionalCharges = $this->input->post('additionalCharges');
              $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
          } else {
  
              $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
          }
            $data['hash'] = hash("sha512", $retHashSeq);
            $data['amount'] = $amount;
            $data['txnid'] = $txnid;
            $data['posted_hash'] = $posted_hash;
            $data['status'] = $status;
            if($status == 'success'){
  
              /**Todo */
              $bookingCode = $txnid;   
              $guestMobile = $productinfo; 
              $guestMobile = preg_replace('/^\+?91|\|91|\D/', '', ($guestMobile));
              

                //Update Booking
                $builder3 = $this->db->table('bookings');
                $builder3->set('booking_status', 'confirmed');
                $builder3->set('payment_status', 'settled');
                $builder3->where('booking_code', $bookingCode);
                $builder3->update();

                /**Todo Insert Payment Transaction */
                
                  $transData = array(

                    'transaction_id'=>$bookingCode,
                    'key'=>$key,
                    'product_info'=>'settled',
                    'name'=> $firstname,
                    'amount'=> $amount,
                    'phone'=> $guestMobile,
                    'email'=> $email,
                    'hash'=>$mode
                
                );
                $builder4 = $this->db->table('transactions');
                $builder4->insert($transData);   


                return redirect()->to(base_url('my-bookings'));     

  
                //$this->render_login('successPaymentRedirect', $data);   
           }
           else{
                // $this->render_login('failPaymentRedirect', $data); 
                return redirect()->to(base_url('my-bookings'));    
           }


    }


 

}
