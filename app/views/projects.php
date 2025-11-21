<?php
// Config ve Router zaten yüklendiği için tekrar include etmiyoruz.

// Header ve Navbar'ı doğru yoldan çağırıyoruz
include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';

// Projeler Dizisi (Burada tutabilirsin)
$projects = [
        [
                "title" => "K8s Cluster Automator",
                "desc" => isset($lang) && $lang == 'tr' ? "Otomatik Kubernetes kurulumu." : "Automated K8s setup.",
                "tags" => ["Terraform", "Ansible", "AWS"],
                "link" => "#"
        ],
        [
                "title" => "CI/CD Pipeline Monitor",
                "desc" => isset($lang) && $lang == 'tr' ? "Jenkins pipeline izleme ve Slack bildirimi." : "Jenkins pipeline monitoring.",
                "tags" => ["Python", "Grafana", "Docker"],
                "link" => "#"
        ],
        [
                "title" => "Serverless Log Analyzer",
                "desc" => isset($lang) && $lang == 'tr' ? "Lambda ile log analizi." : "Log analysis with Lambda.",
                "tags" => ["Node.js", "Serverless", "ELK"],
                "link" => "#"
        ],
        [
                "title" => "Docker Security Scanner",
                "desc" => isset($lang) && $lang == 'tr' ? "Docker imajları için güvenlik taraması." : "Security scanning for Docker images.",
                "tags" => ["Go", "Security", "Shell"],
                "link" => "#"
        ]
];
?>

    <section id="projects">
        <h2 class="section-title"><span>02.</span> <?php echo isset($t['nav_projects']) ? $t['nav_projects'] : 'Projects'; ?></h2>
        <div class="projects-grid">
            <?php foreach($projects as $project): ?>
                <div class="project-card">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                        <i class="far fa-folder folder-icon"></i>
                        <a href="<?php echo $project['link']; ?>" class="github-link"><i class="fab fa-github"></i></a>
                    </div>
                    <h3><?php echo $project['title']; ?></h3>
                    <p><?php echo $project['desc']; ?></p>
                    <div class="project-tags">
                        <?php foreach($project['tags'] as $tag): ?>
                            <span><?php echo $tag; ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

<?php include APP_PATH . '/views/partials/footer.php'; ?>