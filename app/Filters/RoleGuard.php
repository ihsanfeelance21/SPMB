<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class RoleGuard implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // If user is not logged in, they shouldn't even be checked for role
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // $arguments usually contains the allowed roles, e.g. ['admin']
        $userRole = session()->get('role');

        // Superadmin inherits all admin privileges
        if ($userRole === 'superadmin' && $arguments && in_array('admin', $arguments)) {
            return; // Allow access
        }

        if ($arguments && !in_array($userRole, $arguments)) {
            return redirect()->to('/')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing here
    }
}
