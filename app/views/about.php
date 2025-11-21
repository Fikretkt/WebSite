<?php
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'tr';

$translations = [
        'tr' => [
                'title' => 'Merhaba, Ben Fikret 👋',
                'text1' => 'Teknoloji dünyasında <strong>DevOps Engineer</strong> olarak karmaşık sistemleri ölçeklenebilir, güvenli ve otomatik hale getiriyorum.',
                'text2' => 'AWS bulut mimarileri, Kubernetes orkestrasyonu ve CI/CD süreçleri üzerine uzmanlaşıyorum.',
                'skills_title' => 'Teknik Yetkinlikler',
                'btn_work' => 'Benimle Çalış'
        ],
        'en' => [
                'title' => 'Hello, I\'m Fikret 👋',
                'text1' => 'As a <strong>DevOps Engineer</strong>, I make complex systems scalable, secure, and automated in the tech world.',
                'text2' => 'I specialize in AWS cloud architectures, Kubernetes orchestration, and CI/CD processes.',
                'skills_title' => 'Technical Skills',
                'btn_work' => 'Work With Me'
        ],
        'de' => [
                'title' => 'Hallo, ich bin Fikret 👋',
                'text1' => 'Als <strong>DevOps Engineer</strong> mache ich komplexe Systeme in der Technologiewelt skalierbar, sicher und automatisiert.',
                'text2' => 'Ich spezialisiere mich auf AWS-Cloud-Architekturen, Kubernetes-Orchestrierung und CI/CD-Prozesse.',
                'skills_title' => 'Technische Fähigkeiten',
                'btn_work' => 'Arbeite mit mir'
        ]
];
$t = $translations[$lang];

include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';
?>

    <div class="section-container">
        <div class="about-grid">

            <div class="about-content">
                <h2><?php echo $t['title']; ?></h2>
                <p><?php echo $t['text1']; ?></p>
                <p><?php echo $t['text2']; ?></p>

                <div style="margin-top: 30px;">
                    <a href="<?php echo BASE_URL; ?>/index.php/contact?lang=<?php echo $lang; ?>" class="btn btn-primary" style="text-decoration:none; padding: 12px 30px;"><?php echo $t['btn_work']; ?></a>
                </div>
            </div>

            <div>
                <h3 style="color: white; margin-bottom: 20px; font-size: 1.5rem;"><?php echo $t['skills_title']; ?></h3>
                <div class="skill-badges">
                    <div class="skill-badge"><i class="fab fa-aws"></i> AWS Cloud</div>
                    <div class="skill-badge"><i class="fab fa-docker"></i> Docker</div>
                    <div class="skill-badge"><i class="fas fa-dharmachakra"></i> Kubernetes</div>
                    <div class="skill-badge"><i class="fas fa-code-branch"></i> Jenkins CI/CD</div>
                    <div class="skill-badge"><i class="fab fa-linux"></i> Linux / Bash</div>
                    <div class="skill-badge"><i class="fab fa-python"></i> Python</div>
                    <div class="skill-badge"><i class="fas fa-server"></i> Terraform</div>
                </div>
            </div>

        </div>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>