<?php
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'tr';

$translations = [
        'tr' => [
                'title' => 'Projelerim',
                'p1_desc' => 'Terraform ve Ansible kullanarak AWS üzerinde tek tıkla Kubernetes cluster kurulumu.',
                'p2_desc' => 'Jenkins pipeline hatalarını izleyen ve Slack üzerinden bildirim gönderen bot.',
                'p3_desc' => 'Docker imajlarını güvenlik açıklarına karşı tarayan Go tabanlı araç.',
                'p4_desc' => 'AWS Lambda ile CloudWatch loglarını analiz eden sistem.'
        ],
        'en' => [
                'title' => 'My Projects',
                'p1_desc' => 'One-click Kubernetes cluster setup on AWS using Terraform and Ansible.',
                'p2_desc' => 'Bot tracking Jenkins pipeline errors and sending notifications via Slack.',
                'p3_desc' => 'Go-based tool scanning Docker images for security vulnerabilities.',
                'p4_desc' => 'System analyzing CloudWatch logs using AWS Lambda.'
        ],
        'de' => [
                'title' => 'Meine Projekte',
                'p1_desc' => 'Ein-Klick-Kubernetes-Cluster-Setup auf AWS mit Terraform und Ansible.',
                'p2_desc' => 'Bot, der Jenkins-Pipeline-Fehler verfolgt und Benachrichtigungen über Slack sendet.',
                'p3_desc' => 'Go-basiertes Tool zum Scannen von Docker-Images auf Sicherheitslücken.',
                'p4_desc' => 'System zur Analyse von CloudWatch-Protokollen mit AWS Lambda.'
        ]
];
$t = $translations[$lang];

include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';
?>

    <div class="section-container">
        <h2 class="section-title"><?php echo $t['title']; ?></h2>

        <div class="grid-layout">

            <div class="card">
                <div class="card-icon"><i class="fas fa-project-diagram"></i></div>
                <h3>K8s Cluster Automator</h3>
                <p><?php echo $t['p1_desc']; ?></p>
                <div class="tags"><span class="tag">Terraform</span><span class="tag">AWS</span></div>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-robot"></i></div>
                <h3>CI/CD Pipeline Bot</h3>
                <p><?php echo $t['p2_desc']; ?></p>
                <div class="tags"><span class="tag">Python</span><span class="tag">Jenkins</span></div>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-shield-virus"></i></div>
                <h3>Docker Security Scanner</h3>
                <p><?php echo $t['p3_desc']; ?></p>
                <div class="tags"><span class="tag">GoLang</span><span class="tag">Security</span></div>
            </div>

            <div class="card">
                <div class="card-icon"><i class="fas fa-chart-line"></i></div>
                <h3>Serverless Log Analyzer</h3>
                <p><?php echo $t['p4_desc']; ?></p>
                <div class="tags"><span class="tag">AWS Lambda</span><span class="tag">Node.js</span></div>
            </div>

        </div>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>