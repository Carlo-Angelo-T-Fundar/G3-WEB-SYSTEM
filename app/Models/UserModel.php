<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
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
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,{id}]',
        'name'     => 'required|min_length[3]|max_length[100]',
        'email'    => 'required|valid_email|max_length[100]|is_unique[users.email,id,{id}]',
        'password' => 'required|min_length[6]',
        'role'     => 'in_list[Warehouse Manager,Warehouse Staff,Inventory Auditor,Procurement Officer,Accounts Payable Clerk,Accounts Receivable Clerk,IT Administrator,Top Management,admin,user]'
    ];

    protected $validationMessages = [
        'username' => [
            'required'    => 'Username is required.',
            'min_length'  => 'Username must be at least 3 characters long.',
            'max_length'  => 'Username cannot exceed 50 characters.',
            'is_unique'   => 'This username is already taken.'
        ],
        'name' => [
            'required'    => 'Name is required.',
            'min_length'  => 'Name must be at least 3 characters long.',
            'max_length'  => 'Name cannot exceed 100 characters.'
        ],
        'email' => [
            'required'    => 'Email is required.',
            'valid_email' => 'Please enter a valid email address.',
            'max_length'  => 'Email cannot exceed 100 characters.',
            'is_unique'   => 'This email is already registered.'
        ],
        'password' => [
            'required'    => 'Password is required.',
            'min_length'  => 'Password must be at least 6 characters long.'
        ],
        'role' => [
            'in_list'     => 'Please select a valid role.'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Remove automatic password hashing to avoid conflicts
    protected $allowCallbacks = false;

    /**
     * Find user by email or username
     */
    public function findByEmailOrUsername($login)
    {
        return $this->where('email', $login)
                   ->orWhere('username', $login)
                   ->first();
    }

    /**
     * Find user by email only
     */
    public function findByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Find user by username only
     */
    public function findByUsername($username)
    {
        return $this->where('username', $username)->first();
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
    public function searchUsers($searchTerm, $limit = 10)
    {
        return $this->like('name', $searchTerm)
                   ->orLike('username', $searchTerm)
                   ->orLike('email', $searchTerm)
                   ->limit($limit)
                   ->findAll();
    }
}