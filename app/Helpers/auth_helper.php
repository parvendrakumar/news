<?php

if (!function_exists('has_role')) {
    function has_role($roleName) {
        $session = session();
        if (!$session->get('isLoggedIn')) return false;

        $userRole = strtolower($session->get('userRole') ?? '');

        if (is_array($roleName)) {
            return in_array($userRole, array_map('strtolower', $roleName));
        }

        return $userRole === strtolower($roleName);
    }
}

if (!function_exists('check_admin')) {
    function check_admin() {
        if (!has_role('Admin')) {
            session()->setFlashdata('error', 'Access denied. Administrator privileges required.');
            header('Location: ' . base_url('admin/dashboard'));
            exit;
        }
    }
}
