<?php include APP_PATH . '/views/partials/header.php'; ?>
<?php include APP_PATH . '/views/partials/navbar.php'; ?>

    <div id="vanta-bg"></div>

    <section class="hero">
        <div class="hero-content">
            <span class="hero-tag">&lt;Hello World /&gt;</span>

            <h1>Fikret Kocatürk</h1>
            <h2>DevOps Engineer & Cloud Enthusiast</h2>

            <p>
                Modern yazılım süreçlerini hızlandırıyor, ölçeklenebilir bulut altyapıları tasarlıyor
                ve otomasyonun gücüyle sorunsuz sistemler inşa ediyorum.
            </p>

            <div class="btn-group">
                <a href="<?php echo BASE_URL; ?>/index.php/projects" class="btn btn-primary">Projelerimi İncele</a>
                <a href="<?php echo BASE_URL; ?>/index.php/contact" class="btn btn-outline">İletişime Geç</a>
            </div>

            <!-- LOGOLAR BURADA -->
            <div class="tech-stack">
                <i class="fab fa-aws" title="AWS"></i>
                <i class="fab fa-docker" title="Docker"></i>
                <i class="fab fa-linux" title="Linux"></i>
                <i class="fab fa-jenkins" title="Jenkins"></i>
                <i class="fab fa-python" title="Python"></i>
                <i class="fas fa-database" title="Database"></i>
            </div>
        </div>
    </section>
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