<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Default route
$routes->get('/', 'Auth::login');

// Auth routes
$routes->group('auth', function($routes) {
    $routes->get('login', 'Auth::login');
    $routes->post('login', 'Auth::login');
    $routes->get('logout', 'Auth::logout');
    $routes->get('forgotPassword', 'Auth::forgotPassword');
    $routes->post('forgotPassword', 'Auth::forgotPassword');
    $routes->get('profile', 'Auth::profile');
    $routes->post('profile', 'Auth::profile');
});

// Simple routes for backward compatibility
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('logout', 'Auth::logout');

// Role-based dashboard routes
$routes->get('dashboard', 'Auth::redirectToDashboard');

// Accounts Payable routes
$routes->group('accounts-payable', function($routes) {
    $routes->get('dashboard', 'AccountsPayable::dashboard');
    $routes->get('pending-invoices', 'AccountsPayable::pendingInvoices');
    $routes->get('approved-invoices', 'AccountsPayable::approvedInvoices');
    $routes->get('payment-processing', 'AccountsPayable::paymentProcessing');
    $routes->get('vendor-management', 'AccountsPayable::vendorManagement');
    $routes->get('payment-reports', 'AccountsPayable::paymentReports');
    $routes->get('overdue-payments', 'AccountsPayable::overduePayments');
    $routes->get('audit-trail', 'AccountsPayable::auditTrail');
});

// Accounts Receivable routes
$routes->group('accounts-receivable', function($routes) {
    $routes->get('dashboard', 'AccountsReceivable::dashboard');
    // Add more routes as needed
});

// Warehouse routes
$routes->group('warehouse', function($routes) {
    $routes->get('dashboard', 'Warehouse::dashboard');
    // Add more routes as needed
});

// Inventory routes
$routes->group('inventory', function($routes) {
    $routes->get('dashboard', 'Inventory::dashboard');
    // Add more routes as needed
});

// Procurement routes
$routes->group('procurement', function($routes) {
    $routes->get('dashboard', 'Procurement::dashboard');
    // Add more routes as needed
});

// IT Administration routes
$routes->group('it-admin', function($routes) {
    $routes->get('dashboard', 'ITAdmin::dashboard');
    // Add more routes as needed
});

// Management routes
$routes->group('management', function($routes) {
    $routes->get('dashboard', 'Management::dashboard');
    // Add more routes as needed
});