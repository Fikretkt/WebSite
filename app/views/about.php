<?php
// NOT: Config ve değişkenler ($t, $lang) Router (public/index.php) tarafından yüklendi.
// Tekrar include etmeye gerek yok.

// Header'ı çağır (Doğru Yol: views/partials/header.php)
include APP_PATH . '/views/partials/header.php';

// Navbar'ı çağır
include APP_PATH . '/views/partials/navbar.php';

// Hakkımda Çevirileri (Buraya özel)
$about_trans = [
        'tr' => ['title' => 'Hakkımda', 'text' => 'Merhaba! Web geliştirme geçmişimle başlayıp, sistemlerin nasıl daha verimli çalışacağını keşfettikçe <strong>DevOps</strong> dünyasına adım attım. Şu anda Linux sistemleri, konteyner orkestrasyonu ve bulut mimarileri üzerine yoğunlaşıyorum.', 'skills' => 'Kullandığım Teknolojiler:'],
        'en' => ['title' => 'About Me', 'text' => 'Hello! I started with web development and moved into the <strong>DevOps</strong> world as I discovered how to make systems run more efficiently. I focus on Linux, containers, and cloud architectures.', 'skills' => 'Technologies I Use:'],
        'de' => ['title' => 'Über Mich', 'text' => 'Hallo! Ich begann mit der Webentwicklung und wechselte in die <strong>DevOps</strong>-Welt, als ich entdeckte, wie man Systeme effizienter macht. Ich konzentriere mich auf Linux, Container und Cloud-Architekturen.', 'skills' => 'Technologien:']
];
$at = $about_trans[$lang];
?>

    <section id="about">
        <h2 class="section-title"><span>01.</span> <?php echo $at['title']; ?></h2>
        <div class="about-content">
            <div class="bio">
                <p><?php echo $at['text']; ?></p>
            </div>
            <div class="skills">
                <p style="margin-bottom: 15px; font-family: var(--font-code); color: var(--accent-color);"><?php echo $at['skills']; ?></p>
                <div class="skills-container">
                    <span class="skill-badge">Linux / Bash</span>
                    <span class="skill-badge">Docker & K8s</span>
                    <span class="skill-badge">AWS / Azure</span>
                    <span class="skill-badge">Terraform</span>
                    <span class="skill-badge">Jenkins / GitLab CI</span>
                    <span class="skill-badge">Python / Go</span>
                </div>
            </div>
        </div>
    </section>

<?php include APP_PATH . '/views/partials/footer.php'; ?>