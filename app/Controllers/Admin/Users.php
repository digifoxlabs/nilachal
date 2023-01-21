<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Controllers\AdminController;

// Load Model
use App\Models\UserModel;

class Users extends AdminController
{
    public function login()
    {
        $data = array( 
            'pageTitle' => 'NILACHAL-Login',             
        ); 

        if ($this->request->getMethod() == 'post') {

            $rules = [
                'email' => 'required|min_length[3]|max_length[50]|valid_email',
                'password' => 'required|min_length[3]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'password' => [
                    'validateUser' => "Email or Password don't match",
                ],
            ];

            if (!$this->validate($rules, $errors)) {

                return view('admin/pages/login', [
                    "validation" => $this->validator,'pageTitle' => 'MCS-Login',
                ]);
            } else {
                
                $model = new UserModel();
               // $array = array('email' => $this->request->getVar('email'), 'status'=> 1);
                $user = $model->where('email', $this->request->getVar('email'))
                             ->where('status', '1')
                             ->first();
                // Stroing session values

                if($user){

                    $this->setUserSession($user);
                    // Redirecting to dashboard after login
                    return redirect()->to(base_url('admin/dashboard'));

                }

                else {

                    $session = session();
                    $session->setFlashdata('error', 'Invalid User ID');
                    return view('admin/pages/login', ['pageTitle' => 'MCS-Login',
                    ]);

                }
              
            }
        }

        return view('Admin/pages/login', $data);
    }



    private function setUserSession($user)
    {
        $data = [
            'id' => $user['u_id'],
            'name' => $user['name'],
            'mobile' => $user['mobile'],
            'email' => $user['email'],
            'user_type' => $user['user_type'],
            'isLoggedInAdmin' => true,
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();
        // return redirect()->to('admin/login');
        return redirect()->to(base_url('admin/login'));
    }


}
