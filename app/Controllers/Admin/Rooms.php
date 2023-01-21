<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\AdminController;
use App\Models\CategoryModel;
use App\Models\RoomModel;

use CodeIgniter\Files\File;

class Rooms extends AdminController
{

    public function __construct()
    {

        parent::__construct();
        $this->db = db_connect();
    }

    public function index()
    {

        //Fetch data
        $builder = $this->db->table('room_category');
        $builder->select('room_category.*, COUNT(rooms.cat_id) AS roomcount');
        $builder->join('rooms', 'room_category.cat_id = rooms.cat_id', 'LEFT');
        $builder->groupBy('room_category.cat_id');
        $query = $builder->get();
        $catData = $query->getResultArray();

        //Fetch all room category
        //$roomCatModel = new CategoryModel();
        //// $catData = $roomCatModel->findAll();

        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
            'roomCategory' => $catData,
        );
        $this->render_view("Admin/pages/rooms/manage", $data);
    }

    //New Room Category
    public function addRoomCat()
    {

        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
        );

        //Fetch all room category
        $roomCatModel = new CategoryModel();
        $data['roomCategories'] = $roomCatModel->findAll();


        if ($this->request->getPost()) {

            $rules = [
                'room_type' => 'required|trim',
                'room_rate' => 'required|trim|numeric',
                'room_occupancy' => 'required|trim|numeric',
                'room_description' => 'required|trim',       
                'room_image' => 'max_size[room_image,1024]|ext_in[room_image,jpg,jpeg,png]',       
            ];

            $errors = [
                'room_type' => [
                    'required' => "Room Type is Required",
                ],
                'room_rate' => [
                    'required' => "Rate is Required",
                    'numeric' => "Room Rate in Numbers",
                ],
                'room_occupancy' => [
                    'required' => "Enter Max Occupancy",
                    'numeric' => "Max Occupancy in Numbers",
                ],
                'room_image'=>[
                    'uploaded'=> "Upload Image",
                    'max_size'=> "Max Size 1MB",
                ],      
            ];

            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;
                // return view('admin/pages/profile',$data);     
                $this->render_view("Admin/pages/rooms/addcategory", $data);            
            }else {

                $model = new CategoryModel();


                $imageName = null;
                if(!empty($_FILES['roomImage']['name'])){

                    $img = $this->request->getFile('room_image');
                    $imageName = $img->getRandomName();    
                    $path = 'assets/admin/img';
                    $img->move($path,$imageName);

                }

             

                $newData = [
                    'parent_cat_id' => $this->request->getVar('parent_cat_id'),
                    'category' => $this->request->getVar('room_type'),
                    'occupancy' => $this->request->getVar('room_occupancy'),
                    'description' => $this->request->getVar('room_description'),
                    'rate' => $this->request->getVar('room_rate'),
                    'image' => $imageName,
                    'status' => 1,
                ];





                $model->save($newData);
                // $last_id = $model->insertID(); 
               //  echo "Form Submitted with ID:".$last_id;
 
               $session = session();
               $session->setFlashdata('success', 'Created Successfuly');

               return redirect()->to(base_url('admin/rooms'));

               // echo "FORM SUBMITTED";
            }

               

        } else {

            $this->render_view("Admin/pages/rooms/addcategory", $data);
        }
    }

    //Edit Room category
    public function editRoomCat($id){


        //Fetch Room category Data
        $model = new CategoryModel();

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',           
            'catDetails' => $model->where('cat_id', $id)->first(),        
        );

        //Fetch all room category
        $data['roomCategories'] = $model->findAll();
        

        if ($this->request->getPost()) {

            $rules = [
                'room_type' => 'required|trim',
                'room_rate' => 'required|trim|numeric',
                'room_occupancy' => 'required|trim|numeric',
                'room_description' => 'required|trim',       
                'room_image' => 'max_size[room_image,1024]|ext_in[room_image,jpg,jpeg,png]',
            ];

            $errors = [
                'room_type' => [
                    'required' => "Room Type is Required",
                ],
                'room_rate' => [
                    'required' => "Rate is Required",
                    'numeric' => "Room Rate in Numbers",
                ],
                'room_occupancy' => [
                    'required' => "Enter Max Occupancy",
                    'numeric' => "Max Occupancy in Numbers",
                ],   
                'room_image'=>[
                    'max_size'=> "Max Size 1MB",
                ],   
            ];

            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;
                // return view('admin/pages/profile',$data);     
                $this->render_view("Admin/pages/rooms/updatecategory", $data);            
            }else {

           

                $model = new CategoryModel();

                if(!empty($_FILES['room_image']['name'])){

                    $img = $this->request->getFile('room_image');
                    $imageName = $img->getRandomName();    
                
                    $path = 'assets/admin/img';
                    $img->move($path,$imageName);

                    $newData = [
                        'cat_id' => $id,
                        'parent_cat_id' => $this->request->getVar('parent_cat_id'),
                        'category' => $this->request->getVar('room_type'),
                        'occupancy' => $this->request->getVar('room_occupancy'),
                        'description' => $this->request->getVar('room_description'),
                        'rate' => $this->request->getVar('room_rate'),
                        'image' => $imageName,
                        'status' => 1,
                    ];

                }

                else {      

                    $newData = [
                        'cat_id' => $id,
                        'parent_cat_id' => $this->request->getVar('parent_cat_id'),
                        'category' => $this->request->getVar('room_type'),
                        'occupancy' => $this->request->getVar('room_occupancy'),
                        'description' => $this->request->getVar('room_description'),
                        'rate' => $this->request->getVar('room_rate'),
                        'status' => 1,
                    ];

                }         
   

                $model->save($newData);
                // $last_id = $model->insertID();
 
               //  echo "Form Submitted with ID:".$last_id;
 
               $session = session();
               $session->setFlashdata('success', 'Update Successfuly');

               return redirect()->to(base_url('admin/rooms'));

               // echo "FORM SUBMITTED";
            }


        }
        else {

            $this->render_view("Admin/pages/rooms/updatecategory", $data);
        }

    }

    /**Todo Delete Room category */
    public function deleteRoomCat(){

        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
        );


        if (isset($_POST['row_id'])) {      

            $id = $this->request->getVar('row_id');              
            $model = new CategoryModel();
            $model->delete($id );
            $session = session();
            $session->setFlashdata('success', 'Room Deleted');
             return redirect()->to(base_url('admin/rooms/'));
      }
      
      else {
          
          $this->session->set_flashdata('error', 'Error occurred!!');
          return redirect()->to(base_url('admin/rooms/'));
      }   



    }


    //Add Room Numbers
    public function addRoom($cat){

        //Fetch Room category Data
        $model = new CategoryModel();
        $modelRoom = new RoomModel();

        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
            'cat_id' => $cat,
            'catDetails' => $model->where('cat_id', $cat)->first(),
            'roomDetails' => $modelRoom->where('cat_id', $cat)->findAll(),
        );

        $this->render_view("Admin/pages/rooms/addroom", $data);

    }

    //Create Room
    public function createRoomNo(){

        $rules = [
            'room_no' => 'required|trim',
            'status' => 'required|trim',         
              
        ];

        $errors = [  
            'room_no' => [
                'required' => "Enter Room No",
            ],            
        ];

        $cat = $this->request->getVar('cat_id');

        if (!$this->validate($rules,$errors)) {

            $data['validation'] = $this->validator;
            // return view('admin/pages/profile',$data);     
            // $this->render_view('admin/pages/customers/add',$data);   
            $session = session();
            $session->setFlashdata('error', 'Error');
            return redirect()->to(base_url('admin/rooms/add/'.$cat));

        }
        else {

    
            $model = new RoomModel();

            $newData = [
                'cat_id' => $this->request->getVar('cat_id'),
                'room_no' => $this->request->getVar('room_no'),
                'status' => $this->request->getVar('status'),
   
            ];

            $model->save($newData);

                $session = session();
                $session->setFlashdata('success', 'Room Created');
                return redirect()->to(base_url('admin/rooms/add/'.$cat));


        }

    }

    public function updateRoomNo(){


        $rules = [
            'room_no' => 'required|trim',
            'status' => 'required|trim',         
              
        ];

        $errors = [  
            'room_no' => [
                'required' => "Enter Room No",
            ],            
        ];

        $cat = $this->request->getVar('cat_id');

        if (!$this->validate($rules,$errors)) {

            $data['validation'] = $this->validator;
            // return view('admin/pages/profile',$data);     
            // $this->render_view('admin/pages/customers/add',$data);   
            $session = session();
            $session->setFlashdata('error', 'Error');
            return redirect()->to(base_url('admin/rooms/add/'.$cat));

        }
        else {

    
            $model = new RoomModel();

            $newData = [

                'room_id' => $this->request->getVar('row_id'),
                'cat_id' => $this->request->getVar('cat_id'),
                'room_no' => $this->request->getVar('room_no'),
                'status' => $this->request->getVar('status'),
                'booking_code' => $this->request->getVar('booking_code'),
   
            ];

            $model->save($newData);

                $session = session();
                $session->setFlashdata('success', 'Room Updated');
                return redirect()->to(base_url('admin/rooms/add/'.$cat));


        }


    }

    public function deleteRoomNo(){

        if (isset($_POST['row_id'])) {      
            $id = $this->request->getVar('row_id');                
            $cat_id = $this->request->getVar('cat_id');                
            $model = new RoomModel();
            $model->delete($id );
            $session = session();
            $session->setFlashdata('success', 'Room Deleted');
            return redirect()->to(base_url('admin/rooms/add/'.$cat_id));
      }
      
      else {
          
          $this->session->set_flashdata('error', 'Error occurred!!');
          return redirect()->to(base_url('admin/rooms/'));
      }   


    }




}
