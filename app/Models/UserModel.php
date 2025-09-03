<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    
    // Fields that match your exact table structure
    protected $allowedFields = [
        'username',
        'name',
        'email', 
        'password',
        'role',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation rules based on your table constraints
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,{id}]',
        'name' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|max_length[100]|is_unique[users.email,id,{id}]',
        'password' => 'required|min_length[6]',
        'role' => 'in_list[admin,user]'
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username is required',
            'min_length' => 'Username must be at least 3 characters long',
            'max_length' => 'Username cannot exceed 50 characters',
            'is_unique' => 'This username is already taken'
        ],
        'name' => [
            'required' => 'Name is required',
            'min_length' => 'Name must be at least 3 characters long',
            'max_length' => 'Name cannot exceed 100 characters'
        ],
        'email' => [
            'required' => 'Email is required',
            'valid_email' => 'Please enter a valid email address',
            'max_length' => 'Email cannot exceed 100 characters',
            'is_unique' => 'This email is already registered'
        ],
        'password' => [
            'required' => 'Password is required',
            'min_length' => 'Password must be at least 6 characters long'
        ],
        'role' => [
            'in_list' => 'Role must be either admin or user'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $beforeUpdate = [];

    /**
     * Find user by email
     */
    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Find user by username
     */
    public function findByUsername($username)
    {
        return $this->where('username', $username)->first();
    }

    /**
     * Find user by email or username
     */
    public function findByEmailOrUsername($identifier)
    {
        return $this->groupStart()
                    ->where('email', $identifier)
                    ->orWhere('username', $identifier)
                    ->groupEnd()
                    ->first();
    }

    /**
     * Verify user password
     */
    public function verifyPassword($password, $hashedPassword)
    {
        return password_verify($password, $hashedPassword);
    }

    /**
     * Get user profile with safe data (without password)
     */
    public function getUserProfile($userId)
    {
        return $this->select('id, username, name, email, role, created_at, updated_at')
                    ->find($userId);
    }

    /**
     * Get users by role
     */
    public function getUsersByRole($role)
    {
        return $this->where('role', $role)->findAll();
    }

    /**
     * Search users by name, username or email
     */
    public function searchUsers($searchTerm)
    {
        return $this->groupStart()
                    ->like('name', $searchTerm)
                    ->orLike('username', $searchTerm)
                    ->orLike('email', $searchTerm)
                    ->groupEnd()
                    ->findAll();
    }

    /**
     * Get admin users
     */
    public function getAdmins()
    {
        return $this->where('role', 'admin')->findAll();
    }

    /**
     * Get regular users
     */
    public function getRegularUsers()
    {
        return $this->where('role', 'user')->findAll();
    }

    /**
     * Update user role
     */
    public function updateRole($userId, $role)
    {
        if (in_array($role, ['admin', 'user'])) {
            return $this->update($userId, ['role' => $role]);
        }
        return false;
    }

    /**
     * Get user statistics
     */
    public function getUserStats()
    {
        $total = $this->countAll();
        $admins = $this->where('role', 'admin')->countAllResults();
        $users = $this->where('role', 'user')->countAllResults();
        $today = $this->where('DATE(created_at)', date('Y-m-d'))->countAllResults();

        return [
            'total' => $total,
            'admins' => $admins,
            'users' => $users,
            'registered_today' => $today
        ];
    }
}