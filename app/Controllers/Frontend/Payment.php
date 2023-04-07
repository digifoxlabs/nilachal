<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\FrontendController;

class Payment extends FrontendController
{

    /**Initiate Payment */
    public function index()
    {
        
        $status = $this->request->getVar('status');
        if (empty($status)) {
              return redirect()->to(base_url('my-bookings'));    
          }
         
          $firstname = $this->request->getVar('firstname');
          $amount = $this->request->getVar('amount');
          $txnid = $this->request->getVar('txnid');
          $payid = $this->request->getVar('mihpayid');
          $posted_hash = $this->request->getVar('hash');
          $key = $this->request->getVar('key');
          $productinfo = $this->request->getVar('productinfo');
          $email = $this->request->getVar('email');
          $mode = $this->request->getVar('mode');
          $salt = "UUvOK5cWac8GqrlmSM5uxUcBHuCM5dCR"; //  Your salt
          $add = $this->request->getVar('additionalCharges');
          If (isset($add)) {
              $additionalCharges = $this->request->getVar('additionalCharges');
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
                    'product_info'=>$payid,
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
