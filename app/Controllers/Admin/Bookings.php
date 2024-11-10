<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;

// Load Model
use App\Models\CategoryModel;
use App\Models\DateRangeModel;

class Bookings extends AdminController
{

    public function __construct(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                      
        );
        parent::__construct();
        $this->db = \Config\Database::connect();       

    }


    //All Bookings
    public function index()
    {
        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
             );  
       $this-> render_view("Admin/pages/bookings/all_bookings",$data);
    }


    //New Bookings
    public function newBookings(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
             );  
       $this-> render_view("Admin/pages/bookings/new_bookings",$data);

    }

    //Pending Bookings
    public function pendingBookings(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
             );  
       $this-> render_view("Admin/pages/bookings/pending_bookings",$data);

    }

    //Active Bookings
    public function activeBookings(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
             );  
       $this-> render_view("Admin/pages/bookings/active_bookings",$data);

    }
    //Completed Bookings
    public function completedBookings(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
             );  
       $this-> render_view("Admin/pages/bookings/completed_bookings",$data);

    }


    //Fetch Bookings for Ajax cALL
    public function fetchBookings(){

        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        /* If we pass any extra data in request from ajax */
        //$value1 = isset($_REQUEST['key1'])?$_REQUEST['key1']:"";

        $valueStatus = isset($_REQUEST['status'])?$_REQUEST['status']:"";
       

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];

        if(!empty($search_value)){
            // If we have value in search, searching by id, name, email, mobile

            // count all data          

                $total_count = $this->db->query("SELECT * from bookings WHERE booking_code like '%".$search_value."%' OR guest_name like '%".$search_value."%'")->getResult();
                $data = $this->db->query("SELECT * from bookings WHERE booking_code like '%".$search_value."%' OR guest_name like '%".$search_value."%' limit $start, $length")->getResult();
                     
        }
        
        else if(!empty($valueStatus)){
            // If we have value in booking status
            // count all data 
   
                 $total_count = $this->db->query("SELECT * from bookings WHERE booking_status='".$valueStatus."'")->getResult();
                 $data = $this->db->query("SELECT * from bookings WHERE booking_status='".$valueStatus."'")->getResult();
            
        }        
        
        else{
            // count all data for admin

                $total_count = $this->db->query("SELECT * from bookings")->getResult();
                // get per page data
                 $data = $this->db->query("SELECT * from bookings limit $start, $length")->getResult();
            

        }
        
        $json_data = array(
            "draw" => intval($params['draw']),
            "recordsTotal" => count($total_count),
            "recordsFiltered" => count($total_count),
            "data" => $data   // total data array
        );

        echo json_encode($json_data);        



    }


    /**Delete Bookings
     * 
     * Room Reservation
     * Bookings
     * Transanctions
     */
    public function deleteBooking(){
        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
        );


        if (isset($_POST['row_id'])) {      

            $del_id = $this->request->getVar('row_id');     
            
            //Delete Bookings
            $builder = $this->db->table('bookings');
            $builder->where('booking_code', $del_id);
            $builder->delete();

            //Delete Reservation
            $builder2 = $this->db->table('room_reservation');
            $builder2->where('booking_code', $del_id);
            $builder2->delete();       

            //Delete Transaction
            $builder3 = $this->db->table('transactions');
            $builder3->where('transaction_id', $del_id);
            $builder3->delete();

            $session = session();
            $session->setFlashdata('success', 'Booking Deleted');
             return redirect()->to(base_url('admin/bookings/new'));
      }
      
      else {
          
          $this->session->set_flashdata('error', 'Error occurred!!');
          return redirect()->to(base_url('admin/bookings/new'));
      }   

    }




    /**Offline Booking */
    public function offlineBooking(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
        );  

        unset($_SESSION["cart_item"]);
        unset($_SESSION["bookingID"]);
        unset($_SESSION["start_time"]);
        unset($_SESSION["end_time"]);

        $_SESSION["bookingID"]  = $this->getRandomCode();

       
       $this-> render_view("Admin/pages/bookings/offline/check_dates",$data);

    }

    public function selectOfflineRooms(){

        $data = array( 
        'pageTitle' => 'NILACHAL-ADMIN',                                      
            ); 
          
        if($this->request->getPost()){

            $rules = [
                'check_in' => 'required|trim',  
                'check_out' => 'required|trim',
            ];

            $errors = [
                'check_in' => [
                    'required' => "Check In Date Required",
                ],
                'check_out' => [
                    'required' => "Check In Date Required",
                ],
            ];

            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator; 
                $this->render_view('Admin/pages/bookings/offline/check_dates',$data);   

            }else {

                //Check In Date
                $checkIn = $this->request->getVar('check_in');
                $checkIn = str_replace("/","-",$checkIn);

                //Check Out Date
                $checkOut = $this->request->getVar('check_out');   
                $checkOut = str_replace("/","-",$checkOut);
                
                //No Nights
                $noNights = $this->getNoNights(strtotime($checkIn),strtotime($checkOut)) ;

                $_SESSION['start_time'] =  date('Y-m-d', strtotime($checkIn));
                $_SESSION['end_time'] =  date('Y-m-d', strtotime($checkOut));;


                //Fetch Rooms
                $catModel = new CategoryModel();
                $roomData = $catModel->where('status', 1)->findAll();

                //Load Settings Value
                $data['gst_applied'] = $this->getSettingsvalues('gst');
                $data['discount'] = $this->getSettingsvalues('discount');
                $data['currency'] = $this->getSettingsvalues('currency');

                $data['checkIN'] = $checkIn;
                $data['checkOut'] = $checkOut;
                $data['noNights'] = $noNights;
                $data['roomData'] = $roomData;  

               // $data['gst_applied'] = $siteConfig->gst;  
                


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


                           // print_r($_SESSION["cart_item"]);


                            $this->render_view('Admin/pages/bookings/offline/book_rooms',$data); 
                            break;

                        case "empty":
                            unset($_SESSION["cart_item"]);

                            $this->emptySession($_SESSION['bookingID']);
                            $this->render_view('Admin/pages/bookings/offline/book_rooms',$data); 
                            break;

                        default:
                           // $this->render_view('Admin/pages/bookings/offline/book_rooms',$data); 
                            break;
                    }               

                }

                else {


                    $this->render_view('Admin/pages/bookings/offline/book_rooms',$data); 
                }
                             

            }


        }
        else {

            return redirect()->to(base_url('admin/bookings/offline/check-dates'));
        }

    }

    //Available Rooms
    public function getAvailableRooms($id,$start,$end){

            // Loading Query builder instance
            $builder = $this->db->table('rooms');
            $norooms = $builder->select('room_no')
                                ->where('cat_id', $id)
                                ->countAllResults();


    }

        //Get random booking code
        public function getRandomCode()
        {
        $arrChars = array("A","F","B","C","O","Q","W","E","R","T","Z","X","C","V","N");                        

        return $arrChars[rand(0,(sizeof($arrChars)-1))]."".rand(100,999)
                .strtotime("now"); 


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


    public function offlineBilling(){


        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
                );  
        $this-> render_view("Admin/pages/bookings/offline/billing",$data);


    }

    //Peview Booking
    public function previewBooking(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
             );  

        if($this->request->getPost()){


            if(null != $this->request->getVar('action')){

                switch($this->request->getVar('action')){

                    case 'preview':

                        $data['name'] = $this->request->getVar('name');
                        $data['mobile'] = $this->request->getVar('mobile');
                        $data['email'] = $this->request->getVar('email');
                        $data['identity'] = $this->request->getVar('identity');
                        $data['identity_no'] = $this->request->getVar('identity_no');
                        $data['guests'] = $this->request->getVar('no_guests');
                        $data['address'] = $this->request->getVar('address');
        
                        //Load Settings value
                        $data['gst_applied'] = $this->getSettingsvalues('gst');
                        $data['discount'] = $this->getSettingsvalues('discount');
                        $data['currency'] = $this->getSettingsvalues('currency');
        
                        $this-> render_view("Admin/pages/bookings/offline/preview",$data);
                        break;

                    case "save";

                        $start_time = $_SESSION["start_time"];   
                        $end_time = $_SESSION["end_time"];    

                        $booking_amt = $this->request->getVar('total_price');
                        $state_gst = $this->request->getVar('sgst');
                        $central_gst = $this->request->getVar('cgst');  
                        $pay_mode = $this->request->getVar('payment_mode');                      
                        $discount = $this->request->getVar('discount');
                        $payable_amt = $this->request->getVar('payable_amt');                        
                        $advance = $this->request->getVar('amt_paid');                        
                        $balance = $this->request->getVar('balance_amt');
                        $payment_status = 'pending';
                        if($advance == $payable_amt)$payment_status = 'paid';
                        if($advance != 0)$payment_status = 'partially paid';


                        $guest_name = $this->request->getVar('name');
                        $guest_mobile = $this->request->getVar('mobile');
                        $guest_email = $this->request->getVar('email');
                        $guest_identity = $this->request->getVar('identity');
                        $guest_iden_no = $this->request->getVar('identity_no');
                        $no_guests = $this->request->getVar('no_guests');
                        $guest_address = $this->request->getVar('address');

                        $mode= "OFL";
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
                                'no_nights'=>$nights,
                                'rate'=>$rate

                            );

                        }

                        //save reservation data
                        $builder = $this->db->table('room_reservation');
                        $builder->insertBatch($temp);      

                        //Save Bookings Details
                        $bookData = array(

                            'booking_code'=>$bookingCode,
                            'mode'=>'OFL',
                            'guest_name'=>$guest_name,
                            'guest_mobile'=>$guest_mobile,
                            'guest_email'=>$guest_email,
                            'guest_address'=>$guest_address,
                            'identity'=>$guest_identity,
                            'identity_no'=>$guest_iden_no,
                            'check_in'=>$start_time,
                            'check_out'=>$end_time,
                            'booking_amt'=>$booking_amt,
                            'sgst'=>$state_gst,
                            'cgst'=>$central_gst,
                            'discount'=>$discount,
                            'total_amt'=>$payable_amt,
                            'amt_paid'=>$advance,
                            'balance_amt'=>$balance,
                            'booking_status'=>'confirmed',
                            'payment_status'=>$payment_status,
                            'no_guests'=>$no_guests,
                            'user_id'=>session()->get('u_id'),            
                        );
                        $builder2 = $this->db->table('bookings');
                        $builder2->insert($bookData);   


                        //Save Transactions
                        $transData = array(

                            'transaction_id'=>$bookingCode,
                            'key'=>'OFL',
                            'product_info'=>$payment_status,
                            'name'=>$guest_name,
                            'amount'=>$advance,
                            'phone'=>$guest_mobile,
                            'email'=>$guest_email,
                            'hash'=>$pay_mode
                        
                        );
                        $builder3 = $this->db->table('transactions');
                        $builder3->insert($transData);   


                        return redirect()->to(base_url('admin/bookings'));            

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


    /**VIEW AND PROCESS BOOKINGS FROM BACKEND */

    //View Booking
    public function viewBooking($bkid){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        );  
        //Fetch Booking Data
        $builder = $this->db->table('bookings');
        $builder->where('booking_code', $bkid);
        $data['bookData'] = $builder->get()->getResultArray();
        $this->render_view('Admin/pages/bookings/view_booking',$data); 

    }

    //Update Booking
    public function updateBooking(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        if($this->request->getPost()){


                        $bookingCode = $this->request->getVar('bookingcode');

                        $booking_amt = $this->request->getVar('total_price');
                        $state_gst = $this->request->getVar('sgst');
                        $central_gst = $this->request->getVar('cgst');  
                       // $mode = $this->request->getVar('payment_mode');                      
                        $discount = $this->request->getVar('discount');
                        $payable_amt = $this->request->getVar('total_amt');                        
                        $advance = $this->request->getVar('amt_paid');                        
                        $balance = $this->request->getVar('balance_amt');

                        //Update Booking Table
                        $bookingData = array(

                            'booking_code'=>$bookingCode,                     
                            'booking_amt'=>$booking_amt,
                            'sgst'=>$state_gst,
                            'cgst'=>$central_gst,
                            'discount'=>$discount,
                            'total_amt'=>$payable_amt,
                            'amt_paid'=>$advance,
                            'balance_amt'=>$balance,                         
                        );
                        $builder2 = $this->db->table('bookings');
                        $builder2->where('booking_code', $bookingCode);
                        $builder2->update($bookingData);   
              

                        //Update Reservation Table
                        $item_no = count($this->request->getVar('room_cat'));                     
                        
                            for($i=0; $i<$item_no; $i++) {

                                $row_id = $this->request->getVar('row_id')[$i];
                                $room_cat = $this->request->getVar('room_cat')[$i];
                                $no_rooms = $this->request->getVar('no_rooms')[$i];
                                $rate = $this->request->getVar('rate')[$i];
                                $check_in = $this->request->getVar('check_in')[$i];
                                $check_out = $this->request->getVar('check_out')[$i];
                                $no_nights = $this->request->getVar('nights')[$i];
                                $item_amount = $this->request->getVar('item_amount')[$i];
                  

                                $temp[$i] = array(

                                    'rs_id'=>$row_id,                     
                                    'no_rooms'=> $no_rooms,
                                    'check_in'=>$check_in,
                                    'check_out'=>$check_out,
                                    'no_nights'=>$no_nights,
                                    'rate'=>$rate

                                );

                        }

                        //update reservation data
                        $builder = $this->db->table('room_reservation');
                        $builder->updateBatch($temp, 'rs_id');    

                        $session = session();
                        $session->setFlashdata('success', 'Updated');

                        return redirect()->to(base_url('admin/bookings/update?booking='.$bookingCode));  


        }
        else {

            $bkid = $this->request->getVar("booking");
            //Fetch Booking Data
            $builder = $this->db->table('bookings');
            $builder->where('booking_code', $bkid);
            $data['bookData'] = $builder->get()->getResultArray();

            $data['gst_applied'] = $this->getSettingsvalues('gst');
            $data['discount'] = $this->getSettingsvalues('discount');

            $this->render_view('Admin/pages/bookings/offline/update_booking',$data); 

        }


    }


    //Update Booking Customer Details
    public function updateBookingCustomer(){


        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        if($this->request->getPost()){




                $bookingCode = $this->request->getVar('row_id');
                $guest_name = $this->request->getVar('name');
                $guest_mobile = $this->request->getVar('mobile');
                $guest_email = $this->request->getVar('email');
                $guest_identity = $this->request->getVar('identity');
                $guest_iden_no = $this->request->getVar('identity_no');
                $no_guests = $this->request->getVar('no_guests');
                $guest_address = $this->request->getVar('address');


                //Update Booking Table
                $bookingData = array(
                   
                    'guest_name'=>$guest_name,
                    'guest_mobile'=>$guest_mobile,
                    'guest_email'=>$guest_email,
                    'guest_address'=>$guest_address,
                    'identity'=>$guest_identity,
                    'identity_no'=>$guest_iden_no,   
                    'no_guests'=>$no_guests,                  
            );
                $builder2 = $this->db->table('bookings');
                $builder2->where('booking_code', $bookingCode);
                $builder2->update($bookingData);  

                $session = session();
                $session->setFlashdata('success', 'Updated');

                return redirect()->to(base_url('admin/bookings/view/'.$bookingCode));  

            


        }

        else {

            $bkid = $this->request->getVar("booking");
            //Fetch Booking Data
            $builder = $this->db->table('bookings');
            $builder->where('booking_code', $bkid);
            $data['bookData'] = $builder->get()->getResultArray();

            $this->render_view('Admin/pages/bookings/offline/update_customer',$data); 

        }


    }



    //Active Booking
    public function activateBooking($id){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        $builder = $this->db->table('bookings');
        $builder->set('booking_status', 'active');
        $builder->where('booking_code', $id);
        $builder->update();
        return redirect()->to(base_url('admin/bookings/view/'.$id));  

    }

    //Checking Booking
    public function checkInBooking(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        if($this->request->getPost()){

            $activeID = $this->request->getVar("activeID");

            $builder = $this->db->table('bookings');
            $builder->set('checked_in', '2');
            $builder->where('booking_code', $activeID);
            $builder->update();
            return redirect()->to(base_url('admin/bookings/view/'.$activeID));  

        }

        else {

        // get query variable - name
        $activateCode = $this->request->getVar("activate");
        //Fetch Booking Data
        $builder = $this->db->table('bookings');
        $builder->where('booking_code', $activateCode);
        $data['bookData'] = $builder->get()->getResultArray();

        $this->render_view('Admin/pages/bookings/check_in',$data); 


        }


    }


    //Assign Room
    public function roomAssign(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        // get query variable - name
        $activateCode = $this->request->getVar("assign");
        $data['booking_code'] = $activateCode;
        //Fetch Booking Data
        $builder = $this->db->table('bookings');
        $builder->where('booking_code', $activateCode);
        $data['bookData'] = $builder->get()->getResultArray();

        $this->render_view('Admin/pages/bookings/room_assign',$data); 

    }

    //Select Rooms
    public function selectRooms(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        if($this->request->getPost()){

            $code = $this->request->getVar("booking_code");
            $r_number= $this->request->getVar("r_number");
            $row= $this->request->getVar("row_id");


            for($i=0;$i<(count($r_number));$i++){

                $rooms[] = $this->getRoomNumbyID($r_number[$i]);

                //Update Rooms
                $temp[] = array(
                    'room_id'=>$r_number[$i],
                    'status'=>'booked',
                    'booking_code'=>$code,        
                );
            }

           $builder = $this->db->table('rooms');
           $builder->updateBatch($temp,'room_id');   


           $room_numbers = implode(',',$rooms);

           //Update Reservation
           $builder2 = $this->db->table('room_reservation');
           $builder2->set('room_assigned', $room_numbers);
           $builder2->where('rs_id', $row);
           $builder2->where('booking_code', $code);
           $builder2->update();


           //Update Booking
           $builder3 = $this->db->table('bookings');
           $builder3->set('room_assigned', '2');
           $builder3->where('booking_code', $code);
           $builder3->update();


           return redirect()->to(base_url('admin/bookings/roomAssign?assign='.$code));  


        }

        else {

            $data['booking_code'] = $this->request->getVar("booking_id");
            $data['cat_id'] = $this->request->getVar("cat");
            $data['no_rooms'] = $this->request->getVar("rooms");
            $data['row_id'] = $this->request->getVar("res");

            
            $this->render_view('Admin/pages/bookings/room_select',$data); 

        }

    }

    //Release Rooms
    public function releaseRooms(){    

            $data = array( 
                'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
            ); 


            $code = $this->request->getVar("booking_id");
            $data['cat_id'] = $this->request->getVar("cat");
            $rs_id = $this->request->getVar("res");

            //Release Rooms
                //Get Room Nos from Resrevation table
                $roomArray = $this->getRoomsbyRes($rs_id);
               for($i=0;$i<count($roomArray);$i++){

                    $temp[]= array(
                        'room_no'=>$roomArray[$i],
                        'status'=>'available',
                        'booking_code'=>null,    
                    );

               }

               $builder = $this->db->table('rooms');
               $builder->updateBatch($temp,'room_no');   



            //Update Room Reservation
            $builder2 = $this->db->table('room_reservation');
            $builder2->set('room_assigned', null);
            $builder2->where('rs_id', $rs_id);
            $builder2->where('booking_code', $code);
            $builder2->update();


            //Update Bookings
            $builder3 = $this->db->table('bookings');
            $builder3->set('room_assigned', '1');
            $builder3->where('booking_code', $code);
            $builder3->update();


            return redirect()->to(base_url('admin/bookings/roomAssign?assign='.$code));  



    }


    //Check Out Rooms
    public function checkOutRooms(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        //POST Request
        if($this->request->getPost()){

            if(isset($_POST['confirm_payment'])){

                $code = $this->request->getVar("booking_code");
                $amount = $this->request->getVar("amount");
                $advance = $this->request->getVar("advance");
                $balance = $this->request->getVar("balance");

                $mode = trim($this->request->getVar("payment_mode")); 

                $new_paid = $advance + $balance;
                $new_balance = "0";

                //Update Booking
                $builder3 = $this->db->table('bookings');
                $builder3->set('amt_paid', $new_paid);
                $builder3->set('balance_amt', '0');
                $builder3->set('payment_status', 'settled');
                $builder3->where('booking_code', $code);
                $builder3->update();

                /**Todo Insert Payment Transaction */
                
                  $transData = array(

                    'transaction_id'=>$code,
                    'key'=>'OFL',
                    'product_info'=>'settled',
                    'name'=> $this->getGuestDetailsById($code,'guest_name'),
                    'amount'=>$balance,
                    'phone'=> $this->getGuestDetailsById($code,'guest_mobile'),
                    'email'=> null,
                    'hash'=>$mode
                
                );
                $builder4 = $this->db->table('transactions');
                $builder4->insert($transData);   





                return redirect()->to(base_url('admin/bookings/checkOut?booking='.$code));  


            }

            elseif(isset($_POST['confirm_checkout'])){

                $code = $this->request->getVar("booking_code");

                //Update Booking
                $builder3 = $this->db->table('bookings');
                $builder3->set('checked_out', '2');
                $builder3->set('booking_status', 'complete');
                $builder3->where('booking_code', $code);
                $builder3->update();

                //Release Rooms

                $builder2 = $this->db->table('rooms');
                $builder2->set('status', 'available');
                $builder2->set('booking_code', null);
                $builder2->where('booking_code', $code);
                $builder2->update();

                return redirect()->to(base_url('admin/bookings/view/'.$code)); 
            }          


        }

        //GET Request
        else {

            $code = $this->request->getVar("booking");

            $data['booking_code'] = $code;
            //Fetch Booking Data
            $builder = $this->db->table('bookings');
            $builder->where('booking_code', $code);
            $data['bookData'] = $builder->get()->getResultArray();
       
            $this->render_view('Admin/pages/bookings/check_out',$data); 

        }


    }


    //Get Room Number by ID
    public function getRoomNumbyID($rID){

        $builder3 = $this->db->table('rooms');
        $builder3->select('room_no');
        $builder3->where('room_id', $rID);
        return $builder3->get()->getRow()->room_no;

    }

    //Get Room Numbers from Reservation Table
    public function getRoomsbyRes($rsId){

        $builder3 = $this->db->table('room_reservation');
        $builder3->select('room_assigned');
        $builder3->where('rs_id', $rsId);
        $retData= $builder3->get()->getRow()->room_assigned;

        return explode(',', $retData);

    }


    //PRINT INVOICE
    public function printInvoice(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        if($this->request->getVar("booking")){

            $code = $this->request->getVar("booking");
            $builder = $this->db->table('bookings');
            $builder->where('booking_code', $code);
            $data['bookData'] = $builder->get()->getResultArray();

            $builder2 = $this->db->table('bookings');
            $builder2->select('cgst');
            $builder2->where('booking_code', $code);
            if($builder2->get()->getRow()->cgst == 0){

                return view('Admin/pages/bookings/invoice', $data);

            }

            else {

                return view('Admin/pages/bookings/invoice_gst', $data);

            }

            
       }


    }

    /**Calendar View */
    public function calendarView(){

        $data = array( 
            'pageTitle' => 'NILACHAL-STAY&TOUR'                                         
        ); 

        //Fetch all DateRanges
        $rangeModel = new DateRangeModel();
        $data['dateRanges'] = $rangeModel->findAll();
   

        $this->render_view('Admin/pages/bookings/calendar', $data);


    }

    //Fetch Calendar data
    public function calendar_json(){


        $builder = $this->db->table('bookings');
        $where = "booking_status='confirmed' OR booking_status='active'";
        $builder->where($where);
        $resultArray = $builder->get()->getResultArray();

        foreach($resultArray as $row)
        {
                $data[] = array(
                'id'   => $row["bk_id"],
                'title'   => $row["booking_code"],
                'start'   => $row["check_in"],
                'end'   => $row["check_out"]
                );
        }

        echo json_encode($data);


    }


    //Disable date range

    public function createDateRange(){


        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
        );

        if ($this->request->getPost()) {

            $rules = [
                'disable_category' => 'required|trim',
                'dateType' => 'trim|required',
             
            ];

            $errors = [
                'disable_category' => [
                    'required' => "Category is required",
                ],   
            ];


            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;
   
                $session = session();
                $session->setFlashdata('error',  "Input Field Error");
                return redirect()->to(base_url('admin/bookings/calendar'));  

            }else {

                $model = new DateRangeModel();              

                $newData = [
                    'disable_category' => $this->request->getVar('disable_category'),
                    'date_type' => $this->request->getVar('dateType'),
                    'single_date' => $this->request->getVar('singleDate') ?: null,          
                    'start_date' => $this->request->getVar('startDate') ?: null,          
                    'end_date' => $this->request->getVar('endDate') ?: null,          
                ];


                $model->save($newData);
                // $last_id = $model->insertID(); 
               //  echo "Form Submitted with ID:".$last_id;
 
               $session = session();
               $session->setFlashdata('success', 'Created Successfuly');

               return redirect()->to(base_url('admin/bookings/calendar'));  

               
            }

        }

        else {

            return redirect()->to(base_url('admin/bookings/calendar'));  
        }


    }

    public function deleteDateRange(){

        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
        );


     if (isset($_POST['row_id'])) {      

            $id = $this->request->getVar('row_id');              
            $model = new DateRangeModel();
            $model->delete($id );
            $session = session();
            $session->setFlashdata('success', 'Date Deleted');
            return redirect()->to(base_url('admin/bookings/calendar'));  
      }
      
      else {
        $session = session();
        $session->setFlashdata('error', 'Error occurred!!');
        return redirect()->to(base_url('admin/bookings/calendar'));  
      }   

    }



}

