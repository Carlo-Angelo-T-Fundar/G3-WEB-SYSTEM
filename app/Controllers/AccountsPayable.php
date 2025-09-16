<?php

namespace App\Controllers;

class AccountsPayable extends BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        helper(['form', 'url']);
    }

    private function checkAuth()
    {
        if (!$this->session->get('isLoggedIn')) {
            $this->session->setFlashdata('error', 'Please login to access this page.');
            return redirect()->to(base_url('login'));
        }

        $userRole = $this->session->get('role');
        $allowedRoles = ['Accounts Payable Clerk', 'admin', 'Top Management'];
        
        if (!in_array($userRole, $allowedRoles)) {
            $this->session->setFlashdata('error', 'You do not have permission to access this page.');
            return redirect()->to(base_url('dashboard'));
        }

        return null;
    }

    public function dashboard()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $data = [
            'title' => 'Accounts Payable Dashboard',
            'user' => [
                'username' => $this->session->get('username'),
                'name' => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'role' => $this->session->get('role')
            ]
        ];

        return view('accounts_payable/dashboard', $data);
    }

    public function pendingInvoices()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $data = [
            'title' => 'Pending Invoices',
            'user' => [
                'username' => $this->session->get('username'),
                'name' => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'role' => $this->session->get('role')
            ]
        ];

        return view('accounts_payable/pending_invoices', $data);
    }

    public function approvedInvoices()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $data = [
            'title' => 'Approved Invoices',
            'user' => [
                'username' => $this->session->get('username'),
                'name' => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'role' => $this->session->get('role')
            ]
        ];

        return view('accounts_payable/approved_invoices', $data);
    }

    public function paymentProcessing()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $data = [
            'title' => 'Payment Processing',
            'user' => [
                'username' => $this->session->get('username'),
                'name' => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'role' => $this->session->get('role')
            ]
        ];

        return view('accounts_payable/payment_processing', $data);
    }

    public function vendorManagement()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $data = [
            'title' => 'Vendor Management',
            'user' => [
                'username' => $this->session->get('username'),
                'name' => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'role' => $this->session->get('role')
            ]
        ];

        return view('accounts_payable/vendor_management', $data);
    }

    public function paymentReports()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $data = [
            'title' => 'Payment Reports',
            'user' => [
                'username' => $this->session->get('username'),
                'name' => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'role' => $this->session->get('role')
            ]
        ];

        return view('accounts_payable/payment_reports', $data);
    }

    public function overduePayments()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $data = [
            'title' => 'Overdue Payments',
            'user' => [
                'username' => $this->session->get('username'),
                'name' => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'role' => $this->session->get('role')
            ]
        ];

        return view('accounts_payable/overdue_payments', $data);
    }

    public function auditTrail()
    {
        $authCheck = $this->checkAuth();
        if ($authCheck) return $authCheck;

        $data = [
            'title' => 'Audit Trail',
            'user' => [
                'username' => $this->session->get('username'),
                'name' => $this->session->get('name'),
                'email' => $this->session->get('email'),
                'role' => $this->session->get('role')
            ]
        ];

        return view('accounts_payable/audit_trail', $data);
    }
}