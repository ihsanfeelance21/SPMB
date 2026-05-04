<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::login');

// Auth Routes
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::processLogin');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::processRegister');
$routes->get('forgot-password', 'AuthController::forgotPassword');
$routes->post('forgot-password', 'AuthController::processForgotPassword');
$routes->get('logout', 'AuthController::logout');

// Protected Routes (Admin)
$routes->group('admin', ['filter' => 'role:admin'], static function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('dashboard', 'AdminController::index');

    $routes->get('verifikasi', 'AdminController::verifikasi');
    $routes->post('verifikasi/ubah', 'AdminController::ubahVerifikasi');

    $routes->get('seleksi', 'AdminController::seleksi');
    $routes->post('seleksi/ubah', 'AdminController::ubahSeleksi');

    $routes->get('rekap', 'AdminController::rekap');
    $routes->get('rekap/pdf', 'AdminController::downloadPdf');

    $routes->get('pengaturan', 'AdminController::pengaturan');
    $routes->post('pengaturan', 'AdminController::updatePengaturan');

    $routes->get('akun', 'AdminController::akun');
    $routes->post('akun/password', 'AdminController::ubahPasswordAdmin');
    $routes->post('akun/reset', 'AdminController::resetPasswordUser');
    $routes->post('akun/delete', 'AdminController::deleteUser');
    $routes->post('akun/profil', 'AdminController::updateProfilSuperadmin');

    $routes->get('backup', 'BackupController::index');
    $routes->post('backup/create', 'BackupController::create');
    $routes->post('backup/restore', 'BackupController::restore');
    $routes->get('backup/download/(:any)', 'BackupController::downloadFile/$1');
    $routes->post('backup/delete/(:any)', 'BackupController::deleteFile/$1');
});

// Protected Routes (User)
$routes->group('user', ['filter' => 'role:user'], static function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('dashboard', 'UserController::index');

    $routes->get('biodata', 'UserController::biodata');
    $routes->post('biodata', 'UserController::processBiodata');

    $routes->get('akademik', 'UserController::akademik');
    $routes->post('akademik', 'UserController::processAkademik');

    $routes->get('prestasi', 'UserController::prestasi');
    $routes->post('prestasi', 'UserController::processPrestasi');

    $routes->get('berkas', 'UserController::berkas');
    $routes->post('berkas', 'UserController::processBerkas');

    $routes->get('resume', 'UserController::resume');
    $routes->post('kirim', 'UserController::kirimPendaftaran');

    $routes->get('account', 'UserController::account');
    $routes->post('account', 'UserController::processAccount');
});
