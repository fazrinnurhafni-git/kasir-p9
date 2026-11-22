<?php
require __DIR__ . '/bootstrap.php';

// BARU - Tugas rumah H1: Logout
// Hanya boleh lewat POST + token CSRF yang valid
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_verify(); // <-- ini yang bener, sesuai csrf.php kamu

    // 1. Kosongkan semua data session
    $_SESSION = [];

    // 2. Hapus cookie session di browser
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }

    // 3. Hancurkan session di server
    session_destroy();

    // 4. Buat session baru yang bersih + ID baru
    session_start();
    session_regenerate_id(true);
}

// Balik ke login, apapun yang terjadi
redirect('login.php');