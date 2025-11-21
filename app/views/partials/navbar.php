<?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>
<nav class="navbar">
    <!-- Logo -->
    <a href="<?php echo BASE_URL; ?>/index.php/home" class="logo">&lt;DEVOPS +-/*&gt;</a>

    <!-- Menü Linkleri -->
    <ul class="nav-links">
        <li><a href="<?php echo BASE_URL; ?>/index.php/home?lang=<?php echo $lang; ?>"><?php echo isset($t['nav_home']) ? $t['nav_home'] : 'Ana Sayfa'; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/about?lang=<?php echo $lang; ?>"><?php echo isset($t['nav_about']) ? $t['nav_about'] : 'Hakkımda'; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/projects?lang=<?php echo $lang; ?>"><?php echo isset($t['nav_projects']) ? $t['nav_projects'] : 'Projeler'; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/blog?lang=<?php echo $lang; ?>" style="color: #00f3ff;"><?php echo isset($t['nav_blog']) ? $t['nav_blog'] : 'Blog'; ?></a></li>
        <li><a href="<?php echo BASE_URL; ?>/index.php/contact?lang=<?php echo $lang; ?>"><?php echo isset($t['nav_contact']) ? $t['nav_contact'] : 'İletişim'; ?></a></li>

        <!-- Kullanıcı İşlemleri -->
        <?php if(isset($_SESSION['user_id'])): ?>
            <li><a href="#" style="color: #aaa;">👤 <?php echo htmlspecialchars($_SESSION['username']); ?></a></li>
            <li><a href="<?php echo BASE_URL; ?>/index.php/logout" style="color: #ff4444;">Çıkış</a></li>
        <?php else: ?>
            <li><a href="<?php echo BASE_URL; ?>/index.php/login">Giriş</a></li>
        <?php endif; ?>

        <!-- Dil Seçimi -->
        <li><a href="?lang=<?php echo ($lang == 'tr' ? 'en' : 'tr'); ?>">🌐 <?php echo strtoupper($lang); ?></a></li>
    </ul>

    <!-- Hamburger İkonu -->
    <div class="hamburger">
        <i class="fas fa-bars"></i>
    </div>
</nav>