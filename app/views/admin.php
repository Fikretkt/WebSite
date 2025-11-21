<?php
// 1. YETKİ KONTROLÜ VE GİRİŞ İŞLEMİ (EN BAŞTA OLMALI)
// HTML çıktısından önce işlemleri yapmalıyız.

// Config, DB ve Auth zaten Router'dan geliyor, ama login kontrolü için burada tekrar kontrol etmiyoruz.
// Çünkü login sayfasını ayrı yaptık, burası sadece admin paneli.

// Eğer admin giriş şifresi gönderildiyse kontrol et
$admin_pass = "118631616"; // Basit şifre

// Admin Login Kontrolü (Basit Yöntem)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['password'])) {
    if ($_POST['password'] == $admin_pass) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error = "Hatalı şifre!";
    }
}

// Eğer daha önce giriş yapmamışsa form göster
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Header ve Navbar'ı çağır (HTML çıktısı başlıyor)
    include APP_PATH . '/views/partials/header.php';
    include APP_PATH . '/views/partials/navbar.php';

    echo '<div style="text-align:center; margin-top:100px;">
            <h2>Admin Girişi</h2>';

    if (isset($error)) echo "<p style='color:red;'>$error</p>";

    // Form action'ı kendisine yönlendiriyoruz
    echo '<form method="POST" action="' . BASE_URL . '/index.php/admin">
                <input type="password" name="password" placeholder="Şifre" style="padding:10px; border-radius:5px;">
                <button type="submit" class="btn" style="margin-top:10px;">Giriş</button>
            </form>
          </div>';

    include APP_PATH . '/views/partials/footer.php';
    exit; // Kodun geri kalanını çalıştırma
}

// --- BURADAN SONRASI GİRİŞ YAPMIŞ ADMİN İÇİN ---

// 2. HTML Parçalarını Çağır
include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';

// 3. VERİTABANI BAĞLANTISI
if (!isset($conn) && file_exists(APP_PATH . '/config/db.php')) {
    include APP_PATH . '/config/db.php';
}

// 4. SİLME İŞLEMİ (DELETE)
if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    if (isset($conn)) {
        $stmt = $conn->prepare("DELETE FROM messages WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // JavaScript ile yönlendirme
        echo "<script>window.location.href='" . BASE_URL . "/index.php/admin';</script>";
        exit;
    }
}

// 5. OKUMA İŞLEMİ (READ)
$messages = [];
if (isset($conn)) {
    $stmt = $conn->prepare("SELECT * FROM messages ORDER BY created_at DESC");
    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

    <div style="max-width: 900px; margin: 50px auto; padding: 20px;">
        <h2 class="section-title" style="border-bottom: 1px solid #333; padding-bottom: 10px;">
            Admin Paneli - Gelen Kutusu (<?php echo count($messages); ?>)
        </h2>

        <!-- Çıkış Butonu -->
        <div style="text-align: right; margin-bottom: 20px;">
            <a href="<?php echo BASE_URL; ?>/index.php/logout" style="color: #ff4444;">Admin Çıkış</a>
        </div>

        <?php if(empty($messages)): ?>
            <div style="text-align:center; color:#666; margin-top: 40px;">
                <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 10px;"></i>
                <p>Henüz hiç mesaj yok.</p>
            </div>
        <?php else: ?>
            <div style="display: grid; gap: 20px;">
                <?php foreach($messages as $m): ?>
                    <div style="background: #161616; padding: 20px; border-radius: 12px; border-left: 4px solid #00f3ff; position: relative;">
                        <div style="display:flex; justify-content:space-between; margin-bottom:10px; color:#a0a0a0; font-size:0.85rem;">
                        <span>
                            <i class="fas fa-user"></i> <strong><?php echo htmlspecialchars($m['name']); ?></strong>
                            &lt;<?php echo htmlspecialchars($m['email']); ?>&gt;
                        </span>
                            <span>
                            <i class="far fa-clock"></i> <?php echo $m['created_at']; ?>
                        </span>
                        </div>

                        <p style="color: #e0e0e0; line-height: 1.6; font-size: 1rem;">
                            <?php echo nl2br(htmlspecialchars($m['message'])); ?>
                        </p>

                        <!-- Silme Butonu -->
                        <a href="<?php echo BASE_URL; ?>/index.php/admin?delete_id=<?php echo $m['id']; ?>"
                           onclick="return confirm('Bu mesajı kalıcı olarak silmek istediğine emin misin?')"
                           style="position: absolute; bottom: 15px; right: 20px; color: #ff4757; text-decoration: none; font-size: 0.9rem; border: 1px solid #ff4757; padding: 5px 10px; border-radius: 5px; transition: 0.3s;">
                            <i class="fas fa-trash"></i> Sil
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>