<?php
if (session_status() == PHP_SESSION_NONE) session_start();

// Dil Mantığı (Varsayılan TR)
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'tr';

// Dil Çevirileri
$trans_nav = [
        'tr' => ['home' => 'Ana Sayfa', 'about' => 'Hakkımda', 'projects' => 'Projeler', 'blog' => 'Blog', 'contact' => 'İletişim', 'login' => 'Giriş', 'logout' => 'Çıkış'],
        'en' => ['home' => 'Home', 'about' => 'About', 'projects' => 'Projects', 'blog' => 'Blog', 'contact' => 'Contact', 'login' => 'Login', 'logout' => 'Logout'],
        'de' => ['home' => 'Startseite', 'about' => 'Über mich', 'projects' => 'Projekte', 'blog' => 'Blog', 'contact' => 'Kontakt', 'login' => 'Anmelden', 'logout' => 'Abmelden']
];
$t_nav = $trans_nav[$lang];

// Dil Değiştirme Linki Oluşturucu (Mevcut sayfayı korur)
function getLangLink($newLang) {
    $currentUrl = $_SERVER['REQUEST_URI'];
    $urlParts = parse_url($currentUrl);
    parse_str($urlParts['query'] ?? '', $queryParams);
    $queryParams['lang'] = $newLang;
    return $urlParts['path'] . '?' . http_build_query($queryParams);
}
?>

<nav class="navbar">
    <!-- Logo -->
    <a href="<?php echo BASE_URL; ?>/index.php/home?lang=<?php echo $lang; ?>" class="logo">&lt;DEVOPS +-/*&gt;</a>

    <!-- Menü Linkleri -->
    <ul class="nav-links">
        <li><a href="<?php echo BASE_URL; ?>/index.php/home?lang=<?php echo $lang; ?>"><?php echo $t_nav['home']; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/about?lang=<?php echo $lang; ?>"><?php echo $t_nav['about']; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/projects?lang=<?php echo $lang; ?>"><?php echo $t_nav['projects']; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/blog?lang=<?php echo $lang; ?>" style="color: #00f3ff;"><?php echo $t_nav['blog']; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/contact?lang=<?php echo $lang; ?>"><?php echo $t_nav['contact']; ?></a></li>

        <!-- Dil Seçimi -->
        <li>
            <a href="<?php echo getLangLink('tr'); ?>" class="lang-btn <?php echo $lang == 'tr' ? 'active' : ''; ?>">TR</a>
        </li>
        <li>
            <a href="<?php echo getLangLink('en'); ?>" class="lang-btn <?php echo $lang == 'en' ? 'active' : ''; ?>">EN</a>
        </li>
        <li>
            <a href="<?php echo getLangLink('de'); ?>" class="lang-btn <?php echo $lang == 'de' ? 'active' : ''; ?>">DE</a>
        </li>

        <?php if(isset($_SESSION['user_id'])): ?>
            <li><a href="<?php echo BASE_URL; ?>/index.php/logout" style="color: #ff4444;"><?php echo $t_nav['logout']; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>/index.php/login"><?php echo $t_nav['login']; ?></a></li>
        <?php endif; ?>
    </ul>

    <!-- Hamburger İkonu -->
    <div class="hamburger">
        <i class="fas fa-bars"></i>
    </div>
</nav>