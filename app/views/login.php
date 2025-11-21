<?php
// 1. GİRİŞ KONTROLÜ VE YÖNLENDİRME (EN BAŞTA OLMALI)
// Bu blokta HTML çıktısı OLMAMALIDIR.

// Config ve Router zaten index.php'den geliyor.
// Veritabanı bağlantısı için db.php'yi kontrol edelim (Router'dan gelmemiş olabilir diye)
if (!isset($conn) && file_exists(APP_PATH . '/config/db.php')) {
    include APP_PATH . '/config/db.php';
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        if (isset($conn)) {
            // Kullanıcıyı bul
            $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Giriş Başarılı
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Yönlendirme (Header'dan ÖNCE yapılmalı)
                header("Location: " . BASE_URL . "/index.php/home");
                exit;
            } else {
                $error = "Hatalı e-posta veya şifre!";
            }
        } else {
            $error = "Veritabanı bağlantısı yok.";
        }
    } else {
        $error = "Lütfen tüm alanları doldurun.";
    }
}

// 2. HTML ÇIKTISI (YÖNLENDİRME OLMADIYSA BURADAN DEVAM EDER)
include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';
?>

    <div class="contact-container" style="max-width: 400px; margin-top: 100px;">
        <h2 class="section-title">Giriş Yap</h2>
        <?php if($error): ?>
            <div style="color: red; margin-bottom: 10px; text-align: center;"><?php echo $error; ?></div>
        <?php endif; ?>

        <form class="contact-form" method="POST" action="<?php echo BASE_URL; ?>/index.php/login">
            <div class="form-group">
                <input type="email" name="email" placeholder="E-posta" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Şifre" required>
            </div>
            <button type="submit" class="submit-btn">Giriş Yap</button>
        </form>
        <p style="margin-top: 15px; color: #888; text-align: center;">
            Hesabın yok mu? <a href="<?php echo BASE_URL; ?>/index.php/register" style="color: #00f3ff;">Kayıt Ol</a>
        </p>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>