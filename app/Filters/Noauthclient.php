<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Noauthclient implements FilterInterface
{

    public function before(RequestInterface $request, $arguments = null)
    {
        if (session()->get('isLoggedInClient')) {
            return redirect()->to(site_url('bookings'));
        }
    }


    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
