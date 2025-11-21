<?php
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'tr';
$allowed = ['tr', 'en', 'de'];
if (!in_array($lang, $allowed)) { $lang = 'tr'; }

$translations = [
        'tr' => [
                'tag' => 'Hello World',
                'title' => 'DevOps Engineer & Cloud Enthusiast',
                'desc' => 'Modern yazılım süreçlerini hızlandırıyor, ölçeklenebilir bulut altyapıları tasarlıyor ve otomasyonun gücüyle sorunsuz sistemler inşa ediyorum.',
                'btn_projects' => 'Projelerimi İncele',
                'btn_contact' => 'İletişime Geç'
        ],
        'en' => [
                'tag' => 'Hello World',
                'title' => 'DevOps Engineer & Cloud Enthusiast',
                'desc' => 'Accelerating modern software processes, designing scalable cloud infrastructures, and building seamless systems with the power of automation.',
                'btn_projects' => 'View Projects',
                'btn_contact' => 'Contact Me'
        ],
        'de' => [
                'tag' => 'Hallo Welt',
                'title' => 'DevOps Ingenieur & Cloud-Enthusiast',
                'desc' => 'Beschleunigung moderner Softwareprozesse, Entwurf skalierbarer Cloud-Infrastrukturen und Aufbau nahtloser Systeme mit der Kraft der Automatisierung.',
                'btn_projects' => 'Projekte Ansehen',
                'btn_contact' => 'Kontaktieren'
        ]
];
$t = $translations[$lang];

include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';
?>

    <div id="vanta-bg"></div>

    <section class="hero">
        <div class="hero-content">
            <!-- HELLO WORLD TAGI -->
            <span class="hero-tag">&lt;<?php echo $t['tag']; ?> /&gt;</span>

            <!-- İSİM (MERKEZDE VE BÜYÜK) -->
            <h1>Fikret Kocatürk</h1>

            <!-- ÜNVAN -->
            <h2 class="hero-subtitle"><?php echo $t['title']; ?></h2>

            <!-- AÇIKLAMA -->
            <p><?php echo $t['desc']; ?></p>

            <!-- BUTONLAR -->
            <div class="btn-group">
                <a href="<?php echo BASE_URL; ?>/index.php/projects?lang=<?php echo $lang; ?>" class="btn btn-primary"><?php echo $t['btn_projects']; ?></a>
                <a href="<?php echo BASE_URL; ?>/index.php/contact?lang=<?php echo $lang; ?>" class="btn btn-outline"><?php echo $t['btn_contact']; ?></a>
            </div>

            <!-- LOGOLAR -->
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
                    size: 4.5
                })
            } catch (e) {
                console.error("Vanta.js başlatılamadı:", e);
            }
        });
    </script>

<?php
include APP_PATH . '/views/partials/footer.php';
?>