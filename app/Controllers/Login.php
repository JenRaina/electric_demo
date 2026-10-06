<?php

namespace App\Controllers;

use App\Models\User;

class Login extends BaseController
{
    public function index()
    {
        return view('login', [
            'page'  => 'login',
            'error' => session()->getFlashdata('error')
        ]);
    }

    public function authenticate()
    {
        $email = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $userModel = new User();
        $user = $userModel->findByEmail($email);

        if (
            !$user ||
            !$userModel->verifyPassword($password, $user['password']) ||
            !(bool) ($user['is_active'] ?? true)
        ) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Incorrect email or password. Please try again.');
        }

        session()->set([
            'id'         => $user['id'],
            'email'      => $user['email'],
            'user_type'  => $user['user_type'] ?? 'customer',
            'isLoggedIn' => true
        ]);

        return redirect()->to(site_url('accounts'));
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'));
    }
}