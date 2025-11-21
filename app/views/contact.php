<?php
$lang = isset($_GET['lang']) ? $_GET['lang'] : 'tr';

$translations = [
        'tr' => [
                'title' => 'İletişime Geç',
                'desc' => 'Projeleriniz veya iş birliği için formu doldurabilirsiniz.',
                'label_name' => 'Adınız Soyadınız',
                'label_email' => 'E-posta Adresiniz',
                'label_msg' => 'Mesajınız',
                'btn_send' => 'Mesajı Gönder'
        ],
        'en' => [
                'title' => 'Get in Touch',
                'desc' => 'Feel free to fill out the form for projects or collaboration.',
                'label_name' => 'Full Name',
                'label_email' => 'Email Address',
                'label_msg' => 'Your Message',
                'btn_send' => 'Send Message'
        ],
        'de' => [
                'title' => 'Kontaktieren Sie uns',
                'desc' => 'Füllen Sie das Formular für Projekte oder Zusammenarbeit aus.',
                'label_name' => 'Vollständiger Name',
                'label_email' => 'E-Mail-Adresse',
                'label_msg' => 'Ihre Nachricht',
                'btn_send' => 'Nachricht Senden'
        ]
];
$t = $translations[$lang];

include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';
?>

    <div class="contact-box">
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="color: #00f3ff; font-size: 2rem; margin-bottom: 10px;"><?php echo $t['title']; ?></h2>
            <p style="color: #aaa;"><?php echo $t['desc']; ?></p>
        </div>

        <form action="" method="POST">
            <div class="form-group">
                <label><?php echo $t['label_name']; ?></label>
                <input type="text" name="name" class="form-input" required>
            </div>

            <div class="form-group">
                <label><?php echo $t['label_email']; ?></label>
                <input type="email" name="email" class="form-input" required>
            </div>

            <div class="form-group">
                <label><?php echo $t['label_msg']; ?></label>
                <textarea name="message" class="form-input" rows="5" required></textarea>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> <?php echo $t['btn_send']; ?>
            </button>
        </form>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>