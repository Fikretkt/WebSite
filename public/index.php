<?php
session_start();

// 1. Yolları Tanımla
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/app');
define('PUBLIC_PATH', ROOT_PATH . '/public');

// 2. Base URL ve Rota Mantığı (XAMPP için Güçlendirilmiş)
$script_name = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$base_url = ($script_name === '/') ? '' : $script_name;
define('BASE_URL', $base_url);

// Rota Belirleme (PATH_INFO Öncelikli)
if (isset($_SERVER['PATH_INFO'])) {
    $route = $_SERVER['PATH_INFO'];
} else {
    $request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    // Script adını (index.php) URL'den temizle
    $route = str_replace($_SERVER['SCRIPT_NAME'], '', $request_uri);
    // Klasör yolunu temizle
    $route = str_replace($script_name, '', $route);
}

// Temizlik ve Varsayılan Rota
$route = '/' . ltrim($route, '/');
if ($route === '/' || $route === '') {
    $route = '/home';
}

// 3. Ayarları Yükle
require_once APP_PATH . '/config/config.php';
if (file_exists(APP_PATH . '/config/db.php')) require_once APP_PATH . '/config/db.php';
if (file_exists(APP_PATH . '/config/auth_functions.php')) require_once APP_PATH . '/config/auth_functions.php';

// 4. Yönlendirme (Switch)
switch ($route) {
    case '/home':
        require_once APP_PATH . '/views/home.php';
        break;
    case '/about':
        require_once APP_PATH . '/views/about.php';
        break;
    case '/projects':
        require_once APP_PATH . '/views/projects.php';
        break;
    case '/contact':
        require_once APP_PATH . '/views/contact.php';
        break;
    case '/blog':
        require_once APP_PATH . '/views/blog.php';
        break;
    case '/blog/create':
        require_once APP_PATH . '/views/blog-create.php';
        break;
    case '/blog/details':
        require_once APP_PATH . '/views/blog-details.php';
        break;
    case '/login':
        require_once APP_PATH . '/views/login.php';
        break;
    case '/register':
        require_once APP_PATH . '/views/register.php';
        break;
    case '/logout':
        session_destroy();
        header("Location: " . BASE_URL . "/index.php/home");
        exit;
        break;
    case '/admin':
        require_once APP_PATH . '/views/admin.php';
        break;
    case '/api/ai':
        require_once APP_PATH . '/controllers/ai_backend.php';
        break;
    default:
        http_response_code(404);
        echo "<div style='text-align:center; margin-top:50px; color:#333;'>";
        echo "<h1>404 - Sayfa Bulunamadı</h1>";
        echo "<p>Aranan Rota: " . htmlspecialchars($route) . "</p>";
        echo "<a href='".BASE_URL."/index.php/home'>Ana Sayfaya Dön</a>";
        echo "</div>";
        break;
}
?>