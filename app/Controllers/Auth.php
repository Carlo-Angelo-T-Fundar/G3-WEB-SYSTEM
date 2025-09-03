<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller; 

class Auth extends BaseController
{
    protected $userModel;
    protected $session;
    protected $email;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
        helper(['form', 'url']);
    }

    public function index()
    {
        return redirect()->to('/auth/login');
    }

    public function login()
    {
        // If user is already logged in, redirect to dashboard
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/dashboard');
        }

        $data = [
            'title' => 'Login',
            'validation' => \Config\Services::validation()
        ];

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'login' => 'required', // Can be email or username
                'password' => 'required|min_length[6]'
            ];

            if ($this->validate($rules)) {
                $login = $this->request->getPost('login'); // email or username
                $password = $this->request->getPost('password');

                // Find user by email or username
                $user = $this->userModel->findByEmailOrUsername($login);

                if ($user && password_verify($password, $user['password'])) {
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
                    return redirect()->to('/auth/dashboard');
                } else {
                    $this->session->setFlashdata('error', 'Invalid email/username or password');
                }
            }
        }

        return view('auth/login', $data);
    }

    public function register()
    {
        if ($this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/dashboard');
        }

        $data = [
            'title' => 'Register',
            'validation' => \Config\Services::validation()
        ];

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'name' => 'required|min_length[3]|max_length[100]',
                'email' => 'required|valid_email|max_length[100]|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {
                $userData = [
                    'username' => $this->request->getPost('username'),
                    'name' => $this->request->getPost('name'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => 'user' // Default role
                ];

                if ($this->userModel->insert($userData)) {
                    $this->session->setFlashdata('success', 'Registration successful! Please login.');
                    return redirect()->to('/auth/login');
                } else {
                    $this->session->setFlashdata('error', 'Registration failed. Please try again.');
                }
            }
        }

        return view('auth/register', $data);
    }

    public function dashboard()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
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
            return redirect()->to('/auth/dashboard');
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
                    
                    $resetLink = base_url('auth/resetPassword/' . $token);
                    
                    // Email configuration (you need to set this up in app/Config/Email.php)
                    $this->email->setTo($email);
                    $this->email->setSubject('Password Reset Request');
                    $this->email->setMessage("
                        <h3>Password Reset Request</h3>
                        <p>Hello {$user['name']},</p>
                        <p>You have requested to reset your password. Click the link below to reset it:</p>
                        <p><a href='{$resetLink}'>Reset Password</a></p>
                        <p>This link will expire in 1 hour.</p>
                        <p>If you didn't request this, please ignore this email.</p>
                    ");

                    if ($this->email->send()) {
                        $this->session->setFlashdata('success', 'Password reset link has been sent to your email.');
                    } else {
                        $this->session->setFlashdata('error', 'Failed to send email. Please try again.');
                    }
                } else {
                    $this->session->setFlashdata('error', 'Email not found in our records.');
                }
            }
        }

        return view('auth/forgot_password', $data);
    }

    public function resetPassword($token = null)
    {
        if (!$token) {
            return redirect()->to('/auth/login');
        }

        // Check if token matches session token
        $sessionToken = $this->session->getTempdata('reset_token');
        $userId = $this->session->getTempdata('reset_user_id');

        if (!$sessionToken || $token !== $sessionToken || !$userId) {
            $this->session->setFlashdata('error', 'Invalid or expired reset token.');
            return redirect()->to('/auth/login');
        }

        $user = $this->userModel->find($userId);
        if (!$user) {
            $this->session->setFlashdata('error', 'User not found.');
            return redirect()->to('/auth/login');
        }

        $data = [
            'title' => 'Reset Password',
            'validation' => \Config\Services::validation(),
            'token' => $token
        ];

        if ($this->request->getMethod() === 'POST') {
            $rules = [
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {
                $newPassword = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
                
                if ($this->userModel->update($userId, ['password' => $newPassword])) {
                    // Clear reset session data
                    $this->session->removeTempdata('reset_token');
                    $this->session->removeTempdata('reset_user_id');
                    
                    $this->session->setFlashdata('success', 'Password has been reset successfully. Please login with your new password.');
                    return redirect()->to('/auth/login');
                } else {
                    $this->session->setFlashdata('error', 'Failed to update password. Please try again.');
                }
            }
        }

        return view('auth/reset_password', $data);
    }

    public function logout()
    {
        $this->session->destroy();
        $this->session->setFlashdata('success', 'You have been logged out successfully.');
        return redirect()->to('/auth/login');
    }

    public function profile()
    {
        if (!$this->session->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
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