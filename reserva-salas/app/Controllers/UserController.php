<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends Controller
{
    public function index()
    {
        $model = new UserModel();
        $data['users'] = $model->findAll();
        return view('users/index', $data);
    }

    public function profile()
    {
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->to('/login');
        }

        $userModel = new UserModel();
        $user = $userModel->find($userId);

        if (!$user) {
            return redirect()->to('/login');
        }

        return view('users/profile', ['user' => $user]);
    }
}
