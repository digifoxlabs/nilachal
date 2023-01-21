<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauthadmin implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedInAdmin')) {
            return redirect()->to(site_url('admin'));
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
