<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // Admin Users
            [
                'username' => 'admin',
                'name' => 'System Administrator',
                'email' => 'admin@webuild.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'manager',
                'name' => 'Project Manager',
                'email' => 'manager@webuild.com',
                'password' => password_hash('manager123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],

            // Regular Users
            [
                'username' => 'warehouse_manager',
                'name' => 'John Smith',
                'email' => 'john.smith@webuild.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'warehouse_staff',
                'name' => 'Jane Doe',
                'email' => 'jane.doe@webuild.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'inventory_auditor',
                'name' => 'Mike Johnson',
                'email' => 'mike.johnson@webuild.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'procurement_officer',
                'name' => 'Sarah Wilson',
                'email' => 'sarah.wilson@webuild.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'accounts_payable',
                'name' => 'David Brown',
                'email' => 'david.brown@webuild.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'accounts_receivable',
                'name' => 'Lisa Davis',
                'email' => 'lisa.davis@webuild.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'it_admin',
                'name' => 'Robert Garcia',
                'email' => 'robert.garcia@webuild.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'user',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'top_management',
                'name' => 'Emily Martinez',
                'email' => 'emily.martinez@webuild.com',
                'password' => password_hash('password123', PASSWORD_DEFAULT),
                'role' => 'admin',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        // Insert data
        $this->db->table('users')->insertBatch($data);

        echo "User seeder completed successfully!\n";
        echo "Created " . count($data) . " users:\n";
        echo "- Admin users: admin, manager, top_management\n";
        echo "- Regular users: warehouse_manager, warehouse_staff, inventory_auditor, procurement_officer, accounts_payable, accounts_receivable, it_admin\n";
        echo "Default password for all users: password123 (except admin: admin123, manager: manager123)\n";
    }
}