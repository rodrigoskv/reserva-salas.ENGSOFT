<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function processLogin()
    {
        $session = session();
        $model = new UserModel();
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $user = $model->where('email', $email)->first();

        if ($user && password_verify($password, $user['password'])) {
            $session->set([
                'user_id' => $user['id'],
                'role' => $user['role'], 
            ]);
            return redirect()->to('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials');
        }
    }

    public function register()
    {
        return view('auth/register');
    }

    public function processRegister()
    {
        $model = new UserModel();
        $data = [
            'name' => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role' => 'user', 
        ];
        $model->insert($data);
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
