<?php
include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];

    if (!empty($username) && !empty($email) && !empty($password)) {
        if (isset($conn)) {
            // Şifreyi Hashle
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            try {
                $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
                $stmt->execute(['username' => $username, 'email' => $email, 'password' => $hashed_password]);
                $msg = "<div style='color: #00f3ff; text-align:center; margin-bottom:15px;'>Kayıt başarılı! <a href='" . BASE_URL . "/index.php/login' style='color:white; text-decoration:underline;'>Giriş Yap</a></div>";
            } catch(PDOException $e) {
                $msg = "<div style='color: red; text-align:center; margin-bottom:15px;'>Hata: Bu e-posta veya kullanıcı adı zaten var.</div>";
            }
        } else {
            $msg = "<div style='color: orange; text-align:center; margin-bottom:15px;'>Demo Modu: Veritabanı bağlı değil.</div>";
        }
    } else {
        $msg = "<div style='color: red; text-align:center; margin-bottom:15px;'>Lütfen tüm alanları doldurun.</div>";
    }
}
?>

    <div class="contact-container" style="max-width: 400px; margin-top: 100px;">
        <h2 class="section-title">Kayıt Ol</h2>
        <?php echo $msg; ?>

        <form class="contact-form" method="POST" action="<?php echo BASE_URL; ?>/index.php/register">
            <div class="form-group">
                <input type="text" name="username" placeholder="Kullanıcı Adı" required>
            </div>
            <div class="form-group">
                <input type="email" name="email" placeholder="E-posta" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Şifre" required>
            </div>
            <button type="submit" class="submit-btn">Kayıt Ol</button>
        </form>
        <p style="margin-top: 15px; color: #888; text-align: center;">
            Zaten hesabın var mı? <a href="<?php echo BASE_URL; ?>/index.php/login" style="color: #00f3ff;">Giriş Yap</a>
        </p>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>