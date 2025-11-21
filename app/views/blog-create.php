<?php
// 1. GİRİŞ KONTROLÜ (HTML'den Önce)
// requireLogin fonksiyonu auth_functions.php içinde tanımlıdır.
if (function_exists('requireLogin')) {
    requireLogin();
} else {
    // Eğer fonksiyon yüklenemediyse manuel kontrol
    if (!isset($_SESSION['user_id'])) {
        header("Location: " . BASE_URL . "/index.php/login");
        exit;
    }
}

// 2. VERİTABANI BAĞLANTISI
if (!isset($conn) && file_exists(APP_PATH . '/config/db.php')) {
    include APP_PATH . '/config/db.php';
}

// 3. FORM İŞLEMİ (HTML'den Önce)
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars(trim($_POST['title']));
    $cat_id = $_POST['category'];
    $content = htmlspecialchars(trim($_POST['content']));
    $user_id = $_SESSION['user_id'];

    if (isset($conn) && !empty($title) && !empty($content)) {
        try {
            $stmt = $conn->prepare("INSERT INTO topics (user_id, category_id, title, content) VALUES (?, ?, ?, ?)");
            $stmt->execute([$user_id, $cat_id, $title, $content]);

            // Başarılı ise yönlendirme bayrağını kaldır
            header("Location: " . BASE_URL . "/index.php/blog");
            exit;
        } catch (PDOException $e) {
            $error_msg = "Hata: " . $e->getMessage();
        }
    } else {
        $error_msg = "Lütfen tüm alanları doldurun.";
    }
}

// 4. HTML ÇIKTISI BAŞLANGICI
include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';

// Kategorileri Çek (HTML içinde lazım olacak)
$cats = [];
if (isset($conn)) {
    try {
        $cats_stmt = $conn->query("SELECT * FROM categories");
        if ($cats_stmt) {
            $cats = $cats_stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        // Hata durumunda sessiz kal
    }
}
?>

    <section>
        <div class="contact-container" style="max-width: 700px;">
            <h2 class="section-title">Yeni Konu Başlat</h2>
            <p style="color: #888; margin-bottom: 20px;">Teile deine Erfahrung mit der Community. Bitte wähle die Kategorie sorgfältig.</p>

            <!-- Hata Mesajı Gösterimi -->
            <?php if(!empty($error_msg)): ?>
                <div style="color: red; background: rgba(255,0,0,0.1); padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid red;">
                    <?php echo $error_msg; ?>
                </div>
            <?php endif; ?>

            <form class="contact-form" method="POST" action="<?php echo BASE_URL; ?>/index.php/blog/create?lang=<?php echo $lang; ?>">
                <!-- Başlık -->
                <div class="form-group">
                    <label style="color: #fff;">Titel / Frage</label>
                    <input type="text" name="title" placeholder="z.B. Fehler bei Kubernetes Ingress..." required>
                </div>

                <!-- Kategoriler -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label style="color: #fff;">Hauptkategorie</label>
                        <select name="category" style="width:100%; padding:15px; background:#161616; color:#fff; border:none; border-bottom:2px solid #333;" required>
                            <option value="" disabled selected>Kategori Seçin</option>
                            <?php if(empty($cats)): ?>
                                <option value="" disabled>Kategori Bulunamadı</option>
                            <?php else: ?>
                                <?php foreach($cats as $c): ?>
                                    <option value="<?php echo $c['id']; ?>"><?php echo htmlspecialchars($c['name']); ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label style="color: #fff;">Unterkategorie (Freitext)</label>
                        <input type="text" list="subcats" placeholder="z.B. Networking">
                        <datalist id="subcats">
                            <option value="Networking">
                            <option value="Security">
                            <option value="Installation">
                            <option value="Configuration">
                            <option value="Best Practices">
                        </datalist>
                    </div>
                </div>

                <!-- İçerik -->
                <div class="form-group">
                    <label style="color: #fff;">Dein Beitrag</label>
                    <textarea name="content" rows="10" placeholder="Beschreibe dein Projekt oder Problem im Detail..." required></textarea>
                </div>

                <div class="alert-warning" style="background: rgba(255,0,0,0.1); color: #ff4444; padding: 10px; font-size: 0.8rem; border-radius: 5px;">
                    ⚠️ Hinweis: Einmal veröffentlichte Beiträge können <strong>nicht</strong> bearbeitet werden.
                </div>

                <button type="submit" class="submit-btn" style="width: 100%; margin-top: 20px;">Veröffentlichen</button>
            </form>
        </div>
    </section>

<?php include APP_PATH . '/views/partials/footer.php'; ?>