<?php include APP_PATH . '/views/partials/header.php'; ?>
<?php include APP_PATH . '/views/partials/navbar.php'; ?>

    <div class="projects-container">
        <h2 class="section-title">&lt;Projeler /&gt;</h2>

        <div class="projects-grid">

            <!-- Proje 1 -->
            <div class="project-card">
                <div class="project-icon"><i class="fas fa-network-wired"></i></div>
                <h3>K8s Cluster Automator</h3>
                <p>Terraform ve Ansible kullanarak AWS üzerinde tek tıkla Kubernetes cluster kurulumu sağlayan otomasyon projesi.</p>
                <div class="tech-tags">
                    <span>Terraform</span>
                    <span>Ansible</span>
                    <span>AWS</span>
                </div>
            </div>

            <!-- Proje 2 -->
            <div class="project-card">
                <div class="project-icon"><i class="fas fa-sync-alt"></i></div>
                <h3>CI/CD Pipeline Monitor</h3>
                <p>Jenkins pipeline hatalarını anlık olarak takip eden ve Slack üzerinden ekibe bildirim gönderen Python botu.</p>
                <div class="tech-tags">
                    <span>Python</span>
                    <span>Jenkins API</span>
                    <span>Slack</span>
                </div>
            </div>

            <!-- Proje 3 -->
            <div class="project-card">
                <div class="project-icon"><i class="fas fa-shield-alt"></i></div>
                <h3>Docker Security Scanner</h3>
                <p>Docker imajlarını güvenlik açıklarına karşı tarayan ve raporlayan Go tabanlı CLI aracı.</p>
                <div class="tech-tags">
                    <span>Go</span>
                    <span>Docker</span>
                    <span>Security</span>
                </div>
            </div>

            <!-- Proje 4 -->
            <div class="project-card">
                <div class="project-icon"><i class="fas fa-cloud"></i></div>
                <h3>Serverless Log Analyzer</h3>
                <p>AWS Lambda kullanarak CloudWatch loglarını analiz eden ve anormal durumları tespit eden sistem.</p>
                <div class="tech-tags">
                    <span>AWS Lambda</span>
                    <span>Node.js</span>
                    <span>ELK Stack</span>
                </div>
            </div>

        </div>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>