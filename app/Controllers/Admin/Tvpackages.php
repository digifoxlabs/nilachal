<?php

namespace App\Controllers\Admin;

use App\Controllers\AdminController;
use App\Models\PackageModel;
use App\Models\CategoryModel;
use App\Models\RoomModel;

class Tvpackages extends AdminController
{

    public function __construct(){

        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                      
        );
        parent::__construct();
        $this->db = \Config\Database::connect();       

    }

    //CRUD packages
    public function manage()
    {
        $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
             );  

        //Fetch all packages
        $packModel = new PackageModel();
        $data['packages'] = $packModel->findAll();
       $this-> render_view("Admin/pages/tvpackages/manage",$data);
    }

    //Create packages
    public function create(){

        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
        );


        if ($this->request->getPost()) {

            $rules = [
                'package_name' => 'trim',
                'validity' => 'trim|numeric',
                'amount' => 'trim|numeric',   
            ];

            $errors = [
                'package_name' => [
                    'required' => "Package Name is required",
                ],   
            ];

            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;
   
                $session = session();
                $session->setFlashdata('error',  "Input Field Error");
                return redirect()->to(base_url('admin/packages/manage'));  

            }else {

                $model = new PackageModel();


              

                $newData = [
                    'package' => $this->request->getVar('package_name'),
                    'validity' => $this->request->getVar('validity'),
                    'amount' => $this->request->getVar('amount'),          
                ];


                $model->save($newData);
                // $last_id = $model->insertID(); 
               //  echo "Form Submitted with ID:".$last_id;
 
               $session = session();
               $session->setFlashdata('success', 'Created Successfuly');

               return redirect()->to(base_url('admin/packages/manage'));  

               // echo "FORM SUBMITTED";
            }

               

        } else {

            $this-> render_view("Admin/pages/tvpackages/manage",$data);
        }
    }


    //Update Package

    public function update(){

        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
        );


        if ($this->request->getPost()) {

            $rules = [
                'package_name' => 'trim',
                'validity' => 'trim|numeric',
                'amount' => 'trim|numeric',   
            ];

            $errors = [
                'package_name' => [
                    'required' => "Package Name is required",
                ],   
            ];

            if (!$this->validate($rules,$errors)) {
                $data['validation'] = $this->validator;
   
                $session = session();
                $session->setFlashdata('error',  "Input Field Error");
                return redirect()->to(base_url('admin/packages/manage'));  

            }else {

                $model = new PackageModel();              

                $newData = [
                    'package_id' => $this->request->getVar('package_id'),
                    'package' => $this->request->getVar('package_name'),
                    'validity' => $this->request->getVar('validity'),
                    'amount' => $this->request->getVar('amount'),          
                ];

                 $model->save($newData);
                // $last_id = $model->insertID(); 
               //  echo "Form Submitted with ID:".$last_id;
 
               $session = session();
               $session->setFlashdata('success', 'Updated Successfuly');

               return redirect()->to(base_url('admin/packages/manage'));  

               // echo "FORM SUBMITTED";
            }

               

        } else {

            $this-> render_view("Admin/pages/tvpackages/manage",$data);
        }
    }

    //Delete package
    public function delete(){
        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
        );


     if (isset($_POST['package_id'])) {      

            $id = $this->request->getVar('package_id');              
            $model = new PackageModel();
            $model->delete($id );
            $session = session();
            $session->setFlashdata('success', 'Package Deleted');
            return redirect()->to(base_url('admin/packages/manage'));  
      }
      
      else {
        $session = session();
        $session->setFlashdata('error', 'Error occurred!!');
        return redirect()->to(base_url('admin/packages/manage'));  
      }   

    }

    //View Room Status
    public function assign_room()
    {
        $modelRoom = new RoomModel();
        $modelPackage = new PackageModel();
        $data = array(
            'pageTitle' => 'NILACHAL-ADMIN',
            'roomDetails' => $modelRoom->findAll(),
            'packages' =>$modelPackage->findAll()
        );
       $this-> render_view("Admin/pages/tvpackages/rooms",$data);
    }

    //Add Room Package
    public function assign_room_package(){

             $data = array( 
            'pageTitle' => 'NILACHAL-ADMIN',                                      
                ); 
              
            if($this->request->getPost()){
    
                $rules = [
                    'start_date' => 'required|trim',  
                    'end_date' => 'required|trim',
                    'package' => 'required|trim',
                    'room_id' => 'required|trim',
                ];
    
                $errors = [
                    'start_date' => [
                        'required' => "Select Date",
                    ],
                    'package' => [
                        'required' => "Select Package",
                    ],
                ];
    
                if (!$this->validate($rules,$errors)) {
                    $data['validation'] = $this->validator; 
                    $session = session();
                    $session->setFlashdata('error', 'Error'); 
                    return redirect()->to(base_url('admin/packages/assignRoom'));
    
                }else {

                    $model = new RoomModel();

                    $expiryDate = date('Y-m-d', strtotime($this->request->getVar('end_date')));


                    // echo $this->request->getVar('room_id');

                    // echo $expiryDate;
                    // exit;

                    $newData = [
                        'room_id' => $this->request->getVar('room_id'),
                        'tv_package_expiry' => $expiryDate,                    
                    ];

                    $model->save($newData);

                    $session = session();
                    $session->setFlashdata('success', 'Updated'); 
                    return redirect()->to(base_url('admin/packages/assignRoom'));


                }



            }
        
        }

}
