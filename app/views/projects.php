<?php include APP_PATH . '/views/partials/header.php'; ?>
<?php include APP_PATH . '/views/partials/navbar.php'; ?>

    <div class="section-container">
        <h2 class="section-title">Projelerim</h2>

        <div class="grid-layout">

            <!-- Kart 1 -->
            <div class="card">
                <div class="card-icon"><i class="fas fa-project-diagram"></i></div>
                <h3>K8s Cluster Automator</h3>
                <p>Terraform ve Ansible kullanarak AWS üzerinde tek tıkla, ölçeklenebilir Kubernetes cluster kurulumu sağlayan tam otomasyon.</p>
                <div class="tags">
                    <span class="tag">Terraform</span>
                    <span class="tag">Ansible</span>
                    <span class="tag">AWS EKS</span>
                </div>
            </div>

            <!-- Kart 2 -->
            <div class="card">
                <div class="card-icon"><i class="fas fa-robot"></i></div>
                <h3>CI/CD Pipeline Bot</h3>
                <p>Jenkins pipeline süreçlerini izleyen, hataları analiz eden ve Slack üzerinden yazılım ekibine raporlayan Python botu.</p>
                <div class="tags">
                    <span class="tag">Python</span>
                    <span class="tag">Jenkins API</span>
                    <span class="tag">Slack Bot</span>
                </div>
            </div>

            <!-- Kart 3 -->
            <div class="card">
                <div class="card-icon"><i class="fas fa-shield-virus"></i></div>
                <h3>Docker Security Scanner</h3>
                <p>Docker imajlarını güvenlik açıklarına (CVE) karşı tarayan ve risk skorlaması yapan Go tabanlı CLI aracı.</p>
                <div class="tags">
                    <span class="tag">GoLang</span>
                    <span class="tag">Docker</span>
                    <span class="tag">CyberSec</span>
                </div>
            </div>

            <!-- Kart 4 -->
            <div class="card">
                <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Serverless Log Analyzer</h3>
                <p>AWS Lambda ile CloudWatch loglarını gerçek zamanlı analiz edip anormal durumları (Anomalies) tespit eden sistem.</p>
                <div class="tags">
                    <span class="tag">AWS Lambda</span>
                    <span class="tag">Node.js</span>
                    <span class="tag">ELK Stack</span>
                </div>
            </div>

        </div>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>