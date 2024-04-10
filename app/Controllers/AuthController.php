<?php

namespace App\Controllers;

use App\Libraries\Hashing;

class AuthController extends BaseController
{
    public function register()
    {
        if ($this->request->getMethod() == 'get') {
            return view('auth/register');
        } elseif ($this->request->getMethod() == 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $data = [
                'username' => esc($username),
                'password' => Hashing::pass_enc($password)
            ];

            $adminModel = new \App\Models\AdminModel();

            $query = $adminModel->insert($data);

            if ($query) {
                $response = ['status' => 'true'];
            } else {
                $response = ['status' => 'false', 'message' => 'Something went wrong!'];
            }
            return $this->response->setJSON($response);
        }
    }
    public function login()
    {
        if ($this->request->getMethod() == 'get') {
            return view('auth/login');
        } elseif ($this->request->getMethod() == 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $adminModel = new \App\Models\AdminModel();

            $userData = $adminModel->where('username', esc($username))->first();

            if (is_null($userData)) {
                $response = ['status' => 'error', 'message' => 'Username Not Found!'];
                return $this->response->setJSON($response);
            }

            $verifyPass = Hashing::pass_dec($password, $userData['password']);
            if (!$verifyPass) {
                $response = ['status' => 'error', 'message' => 'You Entered wrong Password!'];
            } else {
                if (!is_null($userData)) {
                    $sessionData = [
                        'username' => $userData['username'],
                        'loggedin' => 'loggedin'
                    ];
                    session()->set($sessionData);
                }
                $response = ['status' => 'success', 'message' => 'Logged-In Succesfully!'];
            }
            return $this->response->setJSON($response);
        }
    }

    public function logout(){
        session_unset();
        session()->destroy();
        return redirect()->to(base_url('admin/login'));
    }
}