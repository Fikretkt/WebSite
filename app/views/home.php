<?php
// Config ve değişkenler Router'dan geliyor.
include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';
?>

    <!-- Hero Section -->
    <header class="hero">
        <!-- 3D Arka Plan -->
        <div id="vanta-bg"></div>

        <!-- İçerik Container -->
        <div class="hero-container">

            <p class="hero-pre">
                <i class="fas fa-code"></i> <?php echo isset($t['hero_greeting']) ? $t['hero_greeting'] : 'Merhaba'; ?>
            </p>

            <h1 class="hero-title">
                Fikret Kocatürk
            </h1>

            <h2 class="hero-subtitle terminal-cursor">
                <?php echo isset($t['hero_title']) ? $t['hero_title'] : 'DevOps Engineer'; ?>
            </h2>

            <p class="hero-desc">
                <?php echo isset($t['hero_desc']) ? $t['hero_desc'] : ''; ?>
            </p>

            <!-- Butonlar -->
            <div class="hero-btns">
                <a href="<?php echo BASE_URL; ?>/index.php/projects?lang=<?php echo $lang; ?>" class="btn btn-primary">
                    <i class="fas fa-rocket"></i> <?php echo isset($t['btn_projects']) ? $t['btn_projects'] : 'Projeler'; ?>
                </a>

                <a href="<?php echo BASE_URL; ?>/index.php/contact?lang=<?php echo $lang; ?>" class="btn btn-secondary">
                    <i class="fas fa-envelope"></i> <?php echo isset($t['nav_contact']) ? $t['nav_contact'] : 'İletişim'; ?>
                </a>
            </div>

            <!-- İkonlar -->
            <div class="hero-icons">
                <i class="fab fa-aws" title="AWS"></i>
                <i class="fab fa-docker" title="Docker"></i>
                <i class="fab fa-linux" title="Linux"></i>
                <i class="fas fa-server" title="Server"></i>
                <i class="fas fa-cloud" title="Cloud"></i>
            </div>
        </div>
    </header>

    <script>
        // Vanta.js Halo Efektini Başlat
        document.addEventListener('DOMContentLoaded', () => {
            try {
                if (typeof THREE === 'undefined') {
                    console.error("Three.js yüklenemedi!");
                    return;
                }
                VANTA.HALO({
                    el: "#vanta-bg",
                    mouseControls: true,
                    touchControls: true,
                    gyroControls: false,
                    minHeight: 200.00,
                    minWidth: 200.00,
                    baseColor: 0x00f3ff,
                    backgroundColor: 0x0d0d0d,
                    amplitudeFactor: 1.5,
                    xOffset: 0.2,
                    yOffset: 0.2,
                    size: 3.5
                })
            } catch (e) {
                console.error("Vanta.js başlatılamadı:", e);
            }
        });
    </script>

<?php
include APP_PATH . '/views/partials/footer.php';
?>