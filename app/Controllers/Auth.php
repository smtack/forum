<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;
    
    public function __construct()
    {
        $this->userModel = model(UserModel::class);
    }

    public function signup(): string
    {
        return view('signup');
    }

    public function register()
    {
        $rules = [
            'user_username' => 'required|min_length[3]|max_length[32]|is_unique[users.user_username]',
            'user_email' => 'required|valid_email|is_unique[users.user_email]',
            'user_password' => 'required',
            'user_password_confirm' => 'required|matches[user_password]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'user_username' => $this->request->getPost('user_username'),
            'user_email' => $this->request->getPost('user_email'),
            'user_password' => $this->request->getPost('user_password'),
        ];

        if ($this->userModel->save($data)) {
            return redirect()->to('/login')->with('success', 'Registration successful. Please log in');
        }

        return redirect()->back()->withInput()->with('error', 'Something went wrong. Please try again later.');
    }

    public function login(): string
    {
        return view('login');
    }

    public function authenticate()
    {
        $rules = [
            'user_email' => 'required|valid_email',
            'user_password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Enter a valid email and password');
        }

        $email = trim($this->request->getPost('user_email'));
        $password = $this->request->getPost('user_password');

        $user = $this->userModel->where('user_email', $email)->first();

        if (!$user || !password_verify($password, $user['user_password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid email or password');
        }

        session()->regenerate(true);

        $session_data = [
            'user_id' => $user['user_id'],
            'user_username' => $user['user_username'],
            'user_level' => $user['user_level'],
            'loggedIn' => true,
        ];

        session()->set($session_data);

        return redirect()->to('/home')->with('success', 'Welcome back to the Forum!');
    }

    public function logout()
    {
        session()->regenerate(true);

        session()->destroy();

        return redirect()->to('/')->with('success', 'You have been logged out');
    }

    public function deleteUser()
    {
        $userId = session()->get('user_id');

        if ($userId) {
            $this->userModel->delete($userId);

            $this->logout();
        }

        return redirect()->back()->with('error', 'Could not find user session');
    }
}
