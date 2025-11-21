<?php
// Config ve Router zaten yüklendiği için tekrar include etmiyoruz.

// Header ve Navbar'ı doğru yoldan çağırıyoruz
include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';

// VERİTABANI BAĞLANTISI (APP_PATH kullanarak)
// Router genelde bunu yükler ama garanti olsun diye kontrol ediyoruz.
if (!isset($conn) && file_exists(APP_PATH . '/config/db.php')) {
    include APP_PATH . '/config/db.php';
}

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        if (isset($conn)) {
            try {
                $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':message', $message);
                $stmt->execute();

                $msg = "<div style='color: #00f3ff; border: 1px solid #00f3ff; padding: 10px; border-radius: 8px; text-align: center; margin-bottom: 20px;'>✅ " . $t['msg_success'] . "</div>";
            } catch(PDOException $e) {
                $msg = "<div style='color: red;'>Hata: " . $e->getMessage() . "</div>";
            }
        } else {
            $msg = "<div style='color: orange;'>Demo Modu: Veritabanı bağlı değil.</div>";
        }
    } else {
        $msg = "<div style='color: red;'>Lütfen tüm alanları doldurun.</div>";
    }
}
?>

    <section id="contact">
        <h2 class="section-title" style="justify-content: center;"><span>03.</span> <?php echo $t['contact_title']; ?></h2>

        <div class="contact-container">
            <p class="contact-text"><?php echo $t['contact_desc']; ?></p>

            <?php echo $msg; ?>

            <!-- Action kısmını BASE_URL ile güncelledik -->
            <form class="contact-form" method="POST" action="<?php echo BASE_URL; ?>/index.php/contact?lang=<?php echo $lang; ?>">
                <div class="form-group">
                    <input type="text" name="name" placeholder="<?php echo $t['form_name']; ?>" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" placeholder="<?php echo $t['form_email']; ?>" required>
                </div>
                <div class="form-group">
                    <textarea name="message" rows="5" placeholder="<?php echo $t['form_msg']; ?>" required></textarea>
                </div>
                <button type="submit" class="submit-btn"><?php echo $t['btn_send']; ?></button>
            </form>
        </div>
    </section>

<?php
// Footer'ı doğru yoldan çağırıyoruz
include APP_PATH . '/views/partials/footer.php';
?>