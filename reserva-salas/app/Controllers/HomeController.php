<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class HomeController extends Controller
{
    public function index()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/login');
    }
}
