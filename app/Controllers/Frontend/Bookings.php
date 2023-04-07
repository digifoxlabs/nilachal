<?php

namespace App\Controllers\Frontend;

use App\Controllers\BaseController;
use App\Controllers\FrontendController;

// Load Model
use App\Models\CategoryModel;

class Bookings extends FrontendController
{

    //Bookings Date Select
    public function index()
    {
        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
                );     
                
        unset($_SESSION["cart_item"]);
        unset($_SESSION["bookingID"]);
        unset($_SESSION["start_time"]);
        unset($_SESSION["end_time"]);

        $_SESSION["bookingID"]  = $this->getRandomCode();   
        $this->render_view('Frontend/pages/bookings/search',$data); 
    }

    //Search Rooms
    public function search(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        );   
        
        if($this->request->getPost()){

            $rules = [
                'check_in' => 'required|trim',  
                'check_out' => 'required|trim',
                'guests' => 'required|trim'
            ];

            $errors = [
                'check_in' => [
                    'required' => "Check In Date Required",
                ],
                'check_out' => [
                    'required' => "Check In Date Required",
                ],
                'guests' => [
                    'required' => "No Guests Required",
                ],

            ];

            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator; 
                $this->render_view('Frontend/pages/bookings/search',$data);   

            }else {


                //Check In Date
                $checkIn = $this->request->getVar('check_in');
                $checkIn = str_replace("/","-",$checkIn);

                //Check Out Date
                $checkOut = $this->request->getVar('check_out');   
                $checkOut = str_replace("/","-",$checkOut);

                $_SESSION['start_time'] =  date('Y-m-d', strtotime($checkIn));
                $_SESSION['end_time'] =  date('Y-m-d', strtotime($checkOut));;
                
                //No Nights
                $noNights = $this->getNoNights(strtotime($checkIn),strtotime($checkOut)) ;

                //No Guests
                $noGuests = $this->request->getVar('guests');

                //Fetch Rooms
                $catModel = new CategoryModel();
                $roomData = $catModel->where('status', 1)->findAll();

                //Load Config
                $siteConfig = new \Config\MyConfig();

                $data['checkIN'] = $checkIn;
                $data['checkOut'] = $checkOut;
                $data['noNights'] = $noNights;
                $data['roomData'] = $roomData;  
                $data['gst_applied'] = $siteConfig->gst;  

                $data['guests'] = $noGuests;


                //Switch Post ACtion
                if(null != $this->request->getVar('action')){

                    switch($this->request->getVar('action')){

                        case "add":

                            $qty = $this->request->getvar('quantity');
                            $cat_id = $this->request->getvar('code');
                            $selRoom = $catModel->find($cat_id);
                            
                            $roomArray = array($selRoom['cat_id'].$selRoom['category']=>array('cat_id'=>$selRoom['cat_id'], 'name'=>$selRoom['category'], 'occupancy'=>$selRoom['occupancy'], 'quantity'=>$qty,'price'=>$selRoom['rate'],'nights'=>$noNights));

                            //  print_r($roomArray);

                            // $data['tempAdd'] = $selRoom;
                            
                            if($qty != 0){

                                if(!empty($_SESSION["cart_item"])) {

                                    if(in_array($selRoom['cat_id'].$selRoom['category'],array_keys($_SESSION["cart_item"]))) {
            
                                        foreach($_SESSION["cart_item"] as $k => $v) {
                                                if($selRoom['cat_id'].$selRoom['category'] == $k) {
                                                    if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                                        $_SESSION["cart_item"][$k]["quantity"] = 0;
                                                    }                     
                                                    $_SESSION["cart_item"][$k]["quantity"] += $qty;                              
                                                    //save in session                                
                                                        // updateSelectedSession($r_id,$quantity,$bookingID);      
                                                        $this->saveInSession($_SESSION['bookingID'],$cat_id,$qty);                                          
                                                }
                                        }
                                    } 
                                    else {
                                        $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$roomArray);
                                        // insertSelectedSession($r_id,$quantity,$bookingID);

                                        $this->saveInSession($_SESSION['bookingID'],$cat_id,$qty);
                                            
                                    }
                                }             

                                else {

                                    $_SESSION["cart_item"] = $roomArray;

                                    $this->saveInSession($_SESSION['bookingID'],$cat_id,$qty);

                                }
                            }        


                          //  print_r($_SESSION["cart_item"]);


                            $this->render_view('Frontend/pages/bookings/result',$data); 
                            break;

                        case "empty":
                            unset($_SESSION["cart_item"]);

                            $this->emptySession($_SESSION['bookingID']);
                            $this->render_view('Frontend/pages/bookings/result',$data);  
                            break;

                        default:
                            // $this->render_view('Admin/pages/bookings/offline/book_rooms',$data); 
                            break;
                    }               

                }

                else {


                    $this->render_view('Frontend/pages/bookings/result',$data); 
                }



            }


        }

        else {

            return redirect()->to(base_url('/bookings'));
        }

    }


    //Save Guest Details
    public function guestDetails(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        );  

        $this->render_view('Frontend/pages/bookings/guests',$data); 

    }

    //Preview Booking
    public function previewBooking(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
             );  

        if($this->request->getPost()){


            if(null != $this->request->getVar('action')){

                switch($this->request->getVar('action')){

                    case 'preview':

                        $data['name'] = $this->request->getVar('name');
                        $data['mobile'] = $this->request->getVar('phone');
                        $data['email'] = $this->request->getVar('email');
                        // $data['identity'] = $this->request->getVar('identity');
                        // $data['identity_no'] = $this->request->getVar('identity_no');
                        $data['guests'] = $this->request->getVar('no_guests');
                        // $data['address'] = $this->request->getVar('address');
        
                        //Load Config
                       // $siteConfig = new \Config\MyConfig();

                        //Load Settings value
                        $data['gst_applied'] = $this->getSettingsvalues('gst');
                        $data['discount'] = $this->getSettingsvalues('discount');
                        $data['currency'] = $this->getSettingsvalues('currency');


        
                       // $data['gst_applied'] = $siteConfig->gst;  
                      //  $data['discount'] = $siteConfig->mydiscount;  
        
                        $this->render_view('Frontend/pages/bookings/preview',$data); 
                        break;

                    case "save";

                        $start_time = $_SESSION["start_time"];   
                        $end_time = $_SESSION["end_time"];    

                        $booking_amt = $this->request->getVar('total_price');
                        $state_gst = $this->request->getVar('sgst');
                        $central_gst = $this->request->getVar('cgst');  
                        // $mode = $this->request->getVar('payment_mode');                      
                        $discount = $this->request->getVar('discount');
                        $payable_amt = $this->request->getVar('payable_amt');   

                        $advance = 0;
                        $balance = $payable_amt;                     
                        // $advance = $this->request->getVar('amt_paid');                        
                       // $balance = $this->request->getVar('balance_amt');
                        $payment_status = 'pending';
                       // if($advance == $payable_amt)$payment_status = 'paid';
                       // if($advance != 0)$payment_status = 'partially paid';


                        $guest_name = $this->request->getVar('name');
                        $guest_mobile = $this->request->getVar('phone');
                        $guest_email = $this->request->getVar('email');
                        // $guest_identity = $this->request->getVar('identity');
                        // $guest_iden_no = $this->request->getVar('identity_no');
                        $no_guests = $this->request->getVar('no_guests');
                        // $guest_address = $this->request->getVar('address');

                        $mode= "WEB";
                        $bookingCode = $_SESSION['bookingID']; 

                        $cart_item = $_SESSION["cart_item"];    
                        foreach ($cart_item as $item1){  

                            $category = $item1['cat_id'];
                            $no_rooms = $item1['quantity'];
                            $rate = $item1['price'];
                            $nights = $item1['nights'];

                            $temp[] = array(

                                'booking_code'=>$bookingCode,
                                'room_cat'=>$category,
                                'no_rooms'=> $no_rooms,
                                'check_in'=>$start_time,
                                'check_out'=>$end_time,
                                'rate'=>$rate,
                                'no_nights'=>$nights,

                            );

                        }

                        //save reservation data
                        $builder = $this->db->table('room_reservation');
                        $builder->insertBatch($temp);      

                        //Save Bookings Details
                        $bookData = array(

                            'booking_code'=>$bookingCode,
                            'mode'=>'WEB',
                            'guest_name'=>$guest_name,
                            'guest_mobile'=>$guest_mobile,
                            'guest_email'=>$guest_email,
                            'guest_address'=>null,
                            'check_in'=>$start_time,
                            'check_out'=>$end_time,
                            'booking_amt'=>$booking_amt,
                            'sgst'=>$state_gst,
                            'cgst'=>$central_gst,
                            'discount'=>$discount,
                            'total_amt'=>$payable_amt,
                            'amt_paid'=>$advance,
                            'balance_amt'=>$balance,
                            'booking_status'=>'pending',
                            'payment_status'=>$payment_status,
                            'no_guests'=>$no_guests,
                            'client_id'=>session()->get('cl_id'),            
                        );
                        $builder2 = $this->db->table('bookings');
                        $builder2->insert($bookData);   

                        //return redirect()->to(base_url('my-bookings'));            

                        //Redirect to Payment Screen
                         /*PAYU*/
                        $MERCHANT_KEY = "q24a5c"; //change  merchant with yours
                        $SALT = "UUvOK5cWac8GqrlmSM5uxUcBHuCM5dCR";  //change salt with yours 

                        $txnid = $bookingCode;

                        //optional udf values 
                        $udf1 = '';
                        $udf2 = '';
                        $udf3 = '';
                        $udf4 = '';
                        $udf5 = '';

                        // $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $balance . '|' . $guest_mobile . '|' . $guest_name . '|' . $guest_email . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;
                        $hashstring = $MERCHANT_KEY . '|' . $txnid . '|' . $balance . '|' . $guest_mobile . '|' . $guest_name . '|' . $guest_email . '|' . $udf1 . '|' . $udf2 . '|' . $udf3 . '|' . $udf4 . '|' . $udf5 . '||||||' . $SALT;

                        // $hash = strtolower(hash('sha512', $hashstring));
                        $hash = hash('sha512', $hashstring);
           

                        $success = base_url('Payment/Status');  
                        $fail = base_url('Payment/Status');
                        $cancel = base_url('Payment/Status');
                
                
                        $data = array(

                            'pageTitle' => 'NILACHAL-STAY&TOUR',
                            'mkey' => $MERCHANT_KEY,
                            'tid' => $txnid,
                            'hash' => $hash,
                            'amount' => $balance,           
                            'name' => $guest_name,
                            'productinfo' => $guest_mobile,
                            'email' =>  $guest_email,
                            'phoneno' =>  $guest_mobile,
                            'address' => 'guwahati',
                            'action' => "https://secure.payu.in", //for live change action  https://secure.payu.in
                            'sucess' => $success,
                            'failure' => $fail,
                            'cancel' => $cancel            
                        );



                        $this->render_view('Frontend/pages/payment',$data);  




                        break;
                    
                    default:
                        echo "bad request";
                        break;
                }

            }
        
        }

        else {

            echo "bad request";

        }

    }

    //FEtch CLient Bookings
    public function allBookings(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        );  

        $data['clientName']=session()->get('name');

        $builder = $this->db->table('bookings');
        $builder->where('client_id', session()->get('cl_id'));
        $data['clientBookings'] = $builder->get()->getResultArray();

        $this->render_view('Frontend/pages/bookings/history',$data); 



    }

    public function saveInSession($code,$room,$r_qty){

        //Check for code and room
        $builder = $this->db->table('sessions');
        //1.Insert           
        $exists = $builder->select('*')
                            ->where('booking_code', $code)
                            ->where('room_cat', $room)
                            ->countAllResults();

                           // echo  $exists;
        if($exists > 0){

           // echo "UPDATED";

            $builder->set('room_selected', 'room_selected+'.$r_qty.'', false);
            $builder->where('booking_code', $code);
            $builder->where('room_cat', $room);
            $builder->update();


        }
        else {

          //  echo "INSERTED";

            $temp_data = [
                'booking_code' => $code,
                'room_cat'  => $room,
                'room_selected'  => $r_qty,
            ];
            
            $builder->insert($temp_data);

        }            

    }

    public function emptySession($code){

            $builder = $this->db->table('sessions');
            $builder->where('booking_code', $code);
            $builder->delete();

    }



            //Get random booking code
            public function getRandomCode()
            {
            $arrChars = array("A","F","B","C","O","Q","W","E","R","T","Z","X","C","V","N");                        
    
            return $arrChars[rand(0,(sizeof($arrChars)-1))]."".rand(100,999)
                    .strtotime("now"); 
    
    
            }


}
