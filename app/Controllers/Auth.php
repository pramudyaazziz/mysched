<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;

class Auth extends BaseController
{
    public function login()
    {
        helper(['form']);
        $data = [
            'title' => 'Login'
        ];
        return view('auth/login', $data);
    }

    public function loginProcess()
    {
        $session = session();
        $user = new User();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $data = $user->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['user_id'],
                    'name' => $data['name'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->route('home');
            } else {
                return redirect()->to('/login')->with('error', 'Password is incorrect');
            }
        } else {
            return redirect()->to('/login')->with('error', 'Username does not exist');
        }
    }

    public function register()
    {
        helper(['form']);
        $data = [
            'title' => 'Register'
        ];
        return view('auth/register', $data);
    }

    public function registerProcess()
    {
        helper(['form']);
        $rules = [
            'name'          => 'required|min_length[5]|max_length[50]',
            'username'         => 'required|min_length[4]|max_length[50]|is_unique[users.username]',
            'email'         => 'required|min_length[4]|max_length[100]|valid_email|is_unique[users.email]',
            'password'      => 'required|min_length[4]|max_length[50]',
            'confirmpassword'  => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $userModel = new User();
            $data = [
                'name'     => $this->request->getVar('name'),
                'username'    => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_BCRYPT)
            ];
            $userModel->save($data);
            return redirect()->to('/login')->with('success', 'Signup Successfull');
        } else {
            $data['validation'] = $this->validator;
            return view('auth/register', $data);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->route('login');
    }
}
