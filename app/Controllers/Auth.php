<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller; 

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }

    public function index()
    {
        return redirect()->to(base_url('login'));
    }

    public function login()
    {
        // If user is already logged in, redirect to dashboard
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'login' => 'required',
                'password' => 'required|min_length[6]'
            ];

            if ($this->validate($rules)) {
                $login = $this->request->getPost('login');
                $password = $this->request->getPost('password');
                $role = $this->request->getPost('role'); // Optional role selection

                // Find user by email or username
                $user = $this->userModel->findByEmailOrUsername($login);

                if ($user && password_verify($password, $user['password'])) {
                    // If role is selected, check if it matches user's role
                    if (!empty($role) && $user['role'] !== $role) {
                        $this->session->setFlashdata('error', 'Selected role does not match your account role.');
                        return redirect()->back()->withInput();
                    }

                    $sessionData = [
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                        'isLoggedIn' => true
                    ];
                    
                    $this->session->set($sessionData);
                    $this->session->setFlashdata('success', 'Login successful!');
                    return redirect()->to(base_url('dashboard'));
                } else {
                    $this->session->setFlashdata('error', 'Invalid email/username or password');
                    return redirect()->back()->withInput();
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/login', $data);
    }

    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn')) {
            $this->session->setFlashdata('error', 'Please login to access the dashboard.');
            return redirect()->to(base_url('login'));
        }

        $data = [
            'title' => 'Dashboard',
            'user' => [
                'username' => $this->session->get('username'),
                'name' => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'role' => $this->session->get('role')
            ]
        ];

        return view('auth/dashboard', $data);
    }

    public function forgotPassword()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('dashboard'));
        }

        $data = [
            'title' => 'Forgot Password',
            'validation' => \Config\Services::validation()
        ];

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'email' => 'required|valid_email'
            ];

            if ($this->validate($rules)) {
                $email = $this->request->getPost('email');
                $user = $this->userModel->where('email', $email)->first();

                if ($user) {
                    // Since your table doesn't have reset_token fields, 
                    // we'll create a simple token and store it in session
                    $token = bin2hex(random_bytes(32));
                    
                    // Store reset data in session (temporary solution)
                    $this->session->setTempdata('reset_token', $token, 3600); // 1 hour
                    $this->session->setTempdata('reset_user_id', $user['id'], 3600);
                    
                    $this->session->setFlashdata('success', 'Password reset instructions have been sent (contact administrator).');
                } else {
                    $this->session->setFlashdata('error', 'Email not found in our records.');
                }
            }
        }

        return view('auth/forgot_password', $data);
    }

    public function logout()
    {
        $this->session->destroy();
        $this->session->setFlashdata('success', 'You have been logged out successfully.');
        return redirect()->to(base_url('login'));
    }

    public function profile()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to(base_url('login'));
        }

        $userId = $this->session->get('user_id');
        $user = $this->userModel->find($userId);

        $data = [
            'title' => 'Profile',
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$userId}]",
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => "required|valid_email|max_length[100]|is_unique[users.email,id,{$userId}]"
            ];

            if ($this->request->getPost('password')) {
                $rules['password'] = 'min_length[6]';
                $rules['confirm_password'] = 'matches[password]';
            }

            if ($this->validate($rules)) {
                $updateData = [
                    'username' => $this->request->getPost('username'),
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email')
                ];

                if ($this->request->getPost('password')) {
                    $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
                }

                if ($this->userModel->update($userId, $updateData)) {
                    // Update session data
                    $this->session->set([
                        'username' => $updateData['username'],
                        'name' => $updateData['name'],
                        'email' => $updateData['email']
                    ]);
                    
                    $this->session->setFlashdata('success', 'Profile updated successfully.');
                } else {
                    $this->session->setFlashdata('error', 'Failed to update profile.');
                }
            }
        }

        return view('auth/profile', $data);
    }
}
