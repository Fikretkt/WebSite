<?php
if (session_status() == PHP_SESSION_NONE) session_start();

// 1. Mevcut Dili Al
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'tr';
$allowed_langs = ['tr', 'en', 'de'];
if (!in_array($lang, $allowed_langs)) { $lang = 'tr'; }

// 2. Sonraki Dil Mantığı
$next_lang_map = ['tr' => 'en', 'en' => 'de', 'de' => 'tr'];
$next_lang = $next_lang_map[$lang];
$next_label = strtoupper($next_lang);

$trans_nav = [
        'tr' => ['home' => 'Ana Sayfa', 'about' => 'Hakkımda', 'projects' => 'Projeler', 'blog' => 'Blog', 'contact' => 'İletişim', 'login' => 'Giriş', 'logout' => 'Çıkış'],
        'en' => ['home' => 'Home', 'about' => 'About', 'projects' => 'Projects', 'blog' => 'Blog', 'contact' => 'Contact', 'login' => 'Login', 'logout' => 'Logout'],
        'de' => ['home' => 'Startseite', 'about' => 'Über mich', 'projects' => 'Projekte', 'blog' => 'Blog', 'contact' => 'Kontakt', 'login' => 'Anmelden', 'logout' => 'Abmelden']
];
$t_nav = $trans_nav[$lang];

function getSwitchLangLink($targetLang) {
    $url = $_SERVER['REQUEST_URI'];
    $parts = parse_url($url);
    parse_str($parts['query'] ?? '', $query);
    $query['lang'] = $targetLang;
    return $parts['path'] . '?' . http_build_query($query);
}
?>

<nav class="navbar">
    <!-- DÖNEN ÇARKLI LOGO -->
    <a href="<?php echo BASE_URL; ?>/index.php/home?lang=<?php echo $lang; ?>" class="logo-container">
        <div class="gear-wrapper">
            <i class="fas fa-cog gear gear-big"></i>
            <i class="fas fa-cog gear gear-small"></i>
        </div>
        <span class="logo-text">DEVOPS</span>
    </a>

    <ul class="nav-links">
        <li><a href="<?php echo BASE_URL; ?>/index.php/home?lang=<?php echo $lang; ?>"><?php echo $t_nav['home']; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/about?lang=<?php echo $lang; ?>"><?php echo $t_nav['about']; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/projects?lang=<?php echo $lang; ?>"><?php echo $t_nav['projects']; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/blog?lang=<?php echo $lang; ?>" style="color: #00f3ff;"><?php echo $t_nav['blog']; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/contact?lang=<?php echo $lang; ?>"><?php echo $t_nav['contact']; ?></a></li>

        <li>
            <a href="<?php echo getSwitchLangLink($next_lang); ?>" class="lang-btn">
                <i class="fas fa-globe"></i> <?php echo $next_label; ?>
            </a>
        </li>

        <?php if(isset($_SESSION['user_id'])): ?>
            <li><a href="<?php echo BASE_URL; ?>/index.php/logout" style="color: #ff4444;"><?php echo $t_nav['logout']; ?></a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>/index.php/login"><?php echo $t_nav['login']; ?></a></li>
        <?php endif; ?>
    </ul>

    <div class="hamburger">
        <i class="fas fa-bars"></i>
    </div>
</nav>