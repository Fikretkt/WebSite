<?php include APP_PATH . '/views/partials/header.php'; ?>
<?php include APP_PATH . '/views/partials/navbar.php'; ?>

    <div id="vanta-bg"></div>

    <section class="hero">
        <div style="max-width: 800px;">
            <p style="color: #00f3ff; font-family: 'Fira Code'; margin-bottom: 10px;">&lt;Hello World /&gt;</p>

            <h1>Fikret Kocatürk</h1>
            <h2>DevOps Engineer & Cloud Enthusiast</h2>

            <p style="color: #ccc; line-height: 1.6; font-size: 1.1rem; margin-bottom: 40px;">
                Ölçeklenebilir altyapılar tasarlıyor, CI/CD süreçlerini otomatikleştiriyor ve
                bulutta (AWS) sorunsuz sistemler inşa ediyorum.
            </p>

            <div style="display: flex; gap: 20px; justify-content: center; margin-bottom: 60px;">
                <a href="<?php echo BASE_URL; ?>/index.php/projects" class="btn-submit" style="width: auto; padding: 12px 30px; text-decoration:none;">Projelerimi Gör</a>
                <a href="<?php echo BASE_URL; ?>/index.php/contact" class="btn-submit" style="width: auto; padding: 12px 30px; background: transparent; border: 1px solid white; color: white; text-decoration:none;">İletişim</a>
            </div>

            <!-- BÜYÜTÜLMÜŞ LOGOLAR BURADA -->
            <div class="tech-stack-icons">
                <i class="fab fa-aws" title="AWS"></i>
                <i class="fab fa-docker" title="Docker"></i>
                <i class="fab fa-linux" title="Linux"></i>
                <i class="fab fa-jenkins" title="Jenkins"></i>
                <i class="fab fa-python" title="Python"></i>
                <i class="fas fa-terminal" title="Bash"></i>
            </div>
        </div>
    </section>

<?php include APP_PATH . '/views/partials/footer.php'; ?>