<?php
// Oturum başlat (Eğer başlamadıysa)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Giriş Yapmış mı?
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Admin mi?
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

// Mevcut Kullanıcı Adı
function getCurrentUser() {
    return isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Misafir';
}

// Yetki Kontrolü (Sayfa başında çağrılır)
// Eğer giriş yapmamışsa login sayfasına atar
function requireLogin() {
    if (!isLoggedIn()) {
        // BASE_URL sabiti tanımlıysa kullan, yoksa varsayılan yola git
        $loginPath = defined('BASE_URL') ? BASE_URL . '/index.php/login' : '/index.php/login';
        header("Location: " . $loginPath);
        exit;
    }
}
?>