<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        helper(['form', 'url']);
    }

    public function login()
    {
        return view('auth/v_login');
    }

    public function loginStore()
    {
        $session = session();
        $name = $this->request->getVar('name');
        $password = $this->request->getVar('password');

        $data = $this->userModel->where('name', $name)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'user_id' => $data['user_id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'role' => $data['role'],
                    'isLoggedIn' => TRUE
                ];

                $session->set($ses_data);

                return redirect()->to(base_url('/dashboard'));
            } else {
                $session->setFlashdata('failed', 'Password is incorrect.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('failed', 'Name does not exist.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
