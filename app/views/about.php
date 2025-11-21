<?php include APP_PATH . '/views/partials/header.php'; ?>
<?php include APP_PATH . '/views/partials/navbar.php'; ?>

    <div class="about-container">
        <!-- Sol Taraf: Yazı -->
        <div class="about-text">
            <h2 style="color: #00f3ff;">Hakkımda</h2>
            <p>
                Merhaba! Ben Fikret. Teknoloji ve otomasyona olan tutkum beni DevOps dünyasına yönlendirdi.
                Karmaşık sistemleri basitleştirmeyi, manuel işleri otomatize etmeyi ve "Continuous Everything"
                felsefesini seviyorum.
            </p>
            <p>
                Şu anda AWS üzerinde ölçeklenebilir mimariler kuruyor, Docker ve Kubernetes ile konteyner
                orkestrasyonu sağlıyor ve Jenkins/GitLab CI ile dağıtım süreçlerini hızlandırıyorum.
                Amacım, yazılım geliştirme ve operasyon ekipleri arasındaki köprüyü en verimli şekilde kurmak.
            </p>
        </div>

        <!-- Sağ Taraf: Yetenekler -->
        <div>
            <h3 style="color: white; margin-bottom: 20px;">Teknik Yetkinlikler</h3>
            <div class="skills-grid">
                <div class="skill-item">AWS (EC2, S3, RDS, Lambda)</div>
                <div class="skill-item">Docker & Kubernetes</div>
                <div class="skill-item">CI/CD (Jenkins, GitHub Actions)</div>
                <div class="skill-item">IaC (Terraform, Ansible)</div>
                <div class="skill-item">Linux (Ubuntu, RHEL)</div>
                <div class="skill-item">Scripting (Bash, Python)</div>
                <div class="skill-item">Monitoring (Prometheus, Grafana)</div>
                <div class="skill-item">Database (MySQL, PostgreSQL)</div>
            </div>
        </div>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>