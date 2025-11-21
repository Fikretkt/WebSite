<?php include APP_PATH . '/views/partials/header.php'; ?>
<?php include APP_PATH . '/views/partials/navbar.php'; ?>

    <div class="section-container">
        <div class="about-grid">

            <!-- Sol: Metin -->
            <div class="about-content">
                <h2>Merhaba, Ben Fikret 👋</h2>
                <p>
                    Teknoloji dünyasında <strong>DevOps Engineer</strong> olarak karmaşık sistemleri ölçeklenebilir, güvenli ve otomatik hale getiriyorum.
                    Kod ile altyapı (IaC) kavramını benimsiyor, manuel süreçleri ortadan kaldırarak ekiplerin hızlanmasını sağlıyorum.
                </p>
                <p>
                    AWS bulut mimarileri, Kubernetes orkestrasyonu ve CI/CD süreçleri üzerine uzmanlaşıyorum.
                    Benim için DevOps sadece bir araç seti değil, bir kültür ve sürekli iyileştirme felsefesidir.
                </p>

                <div style="margin-top: 30px;">
                    <a href="<?php echo BASE_URL; ?>/index.php/contact" class="btn btn-primary" style="text-decoration:none; padding: 10px 30px; font-size: 0.9rem;">Benimle Çalış</a>
                </div>
            </div>

            <!-- Sağ: Yetenekler (Badge Tasarımı) -->
            <div>
                <h3 style="color: white; margin-bottom: 20px; font-size: 1.5rem;">Teknik Yetkinlikler</h3>
                <div class="skill-badges">
                    <div class="skill-badge"><i class="fab fa-aws"></i> AWS Cloud</div>
                    <div class="skill-badge"><i class="fab fa-docker"></i> Docker</div>
                    <div class="skill-badge"><i class="fas fa-dharmachakra"></i> Kubernetes</div>
                    <div class="skill-badge"><i class="fas fa-code-branch"></i> Jenkins CI/CD</div>
                    <div class="skill-badge"><i class="fab fa-linux"></i> Linux / Bash</div>
                    <div class="skill-badge"><i class="fab fa-python"></i> Python</div>
                    <div class="skill-badge"><i class="fas fa-server"></i> Terraform</div>
                    <div class="skill-badge"><i class="fas fa-database"></i> SQL / NoSQL</div>
                    <div class="skill-badge"><i class="fas fa-shield-alt"></i> Cyber Security</div>
                </div>
            </div>

        </div>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>