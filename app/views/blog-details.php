<?php
// 1. MANTIK VE VERİTABANI İŞLEMLERİ (HTML Çıktısından Önce Yapılmalı)

// Veritabanı Bağlantısı
if (!isset($conn) && file_exists(APP_PATH . '/config/db.php')) {
    include APP_PATH . '/config/db.php';
}

// Konu ID'sini al
$topic_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$error_msg = "";
$post = null;
$comments = [];

if (isset($conn)) {

    // A) YORUM GÖNDERME İŞLEMİ (POST İsteği)
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Giriş kontrolü
        if (!isset($_SESSION['user_id'])) {
            // Giriş yapmamışsa login sayfasına at
            header("Location: " . BASE_URL . "/index.php/login");
            exit;
        }

        $comment_content = htmlspecialchars(trim($_POST['comment']));
        $user_id = $_SESSION['user_id'];

        if (!empty($comment_content)) {
            try {
                $stmt = $conn->prepare("INSERT INTO comments (topic_id, user_id, content) VALUES (?, ?, ?)");
                $stmt->execute([$topic_id, $user_id, $comment_content]);

                // Başarılı ise sayfayı yenile
                header("Location: " . BASE_URL . "/index.php/blog/details?id=$topic_id&lang=$lang");
                exit;
            } catch (PDOException $e) {
                $error_msg = "Yorum kaydedilemedi: " . $e->getMessage();
            }
        } else {
            $error_msg = "Lütfen boş yorum göndermeyin.";
        }
    }

    // B) KONU DETAYINI ÇEK
    try {
        $stmt = $conn->prepare("SELECT t.*, u.username, c.name as cat_name FROM topics t JOIN users u ON t.user_id = u.id JOIN categories c ON t.category_id = c.id WHERE t.id = ?");
        $stmt->execute([$topic_id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // Hata olursa sessiz kal
    }

    // C) YORUMLARI ÇEK
    try {
        $stmt = $conn->prepare("SELECT c.*, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.topic_id = ? ORDER BY c.created_at ASC");
        $stmt->execute([$topic_id]);
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        // Hata olursa sessiz kal
    }
}

// 2. HTML ÇIKTISI BAŞLANGICI
include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';
?>

    <style>
        .post-wrapper { max-width: 800px; margin: 0 auto; padding: 20px; }

        /* Ana Konu Kartı */
        .main-post {
            background: #161616;
            padding: 25px; /* Küçültüldü */
            border-radius: 10px;
            border: 1px solid #333;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.5);
        }
        .post-header { border-bottom: 1px solid #333; padding-bottom: 10px; margin-bottom: 15px; }
        .post-header h1 { font-size: 1.5rem; color: #fff; margin-bottom: 5px; } /* Başlık küçüldü */
        .post-meta { font-size: 0.8rem; color: #666; font-family: 'Fira Code', monospace; }

        /* Yorumlar Bölümü - DAHA KOMPAKT */
        .comment-section { margin-top: 30px; }
        .comment-card {
            background: #161616;
            padding: 12px 15px; /* Padding yarı yarıya azaldı (20px -> 12px) */
            border-radius: 6px;
            margin-bottom: 10px; /* Boşluk azaldı (15px -> 10px) */
            border-left: 2px solid #444; /* Çizgi inceldi */
            font-size: 0.9rem; /* Yazı boyutu küçüldü */
        }

        .comment-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            align-items: center;
        }

        .comment-author { color: #00f3ff; font-weight: bold; font-size: 0.95rem; }
        .comment-date { color: #555; font-size: 0.75rem; }
        .comment-content { margin: 0; color: #ccc; line-height: 1.4; }

        .alert-error { background: rgba(255, 0, 0, 0.1); color: #ff4444; padding: 10px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #ff4444; }
    </style>

    <section>
        <div class="post-wrapper">
            <!-- Geri Dön Linki -->
            <a href="<?php echo BASE_URL; ?>/index.php/blog?lang=<?php echo $lang; ?>" style="color: #00f3ff; font-size: 0.8rem; text-decoration: none;">
                <i class="fas fa-arrow-left"></i> Geri Dön
            </a>
            <br><br>

            <?php if ($post): ?>
                <!-- ANA KONU -->
                <div class="main-post">
                    <div class="post-header">
                        <h1><?php echo htmlspecialchars($post['title']); ?></h1>
                        <div class="post-meta">
                            Yazar: <span style="color: #00f3ff;"><?php echo htmlspecialchars($post['username']); ?></span> |
                            Kategori: <span style="color: #e0e0e0;"><?php echo htmlspecialchars($post['cat_name']); ?></span> |
                            Tarih: <?php echo date('d.m.Y H:i', strtotime($post['created_at'])); ?>
                        </div>
                    </div>
                    <div class="post-content">
                        <p style="line-height:1.6; color:#ddd; white-space: pre-wrap; font-size: 0.95rem;"><?php echo htmlspecialchars($post['content']); ?></p>
                    </div>
                </div>

                <!-- YORUMLAR BAŞLIĞI -->
                <h4 style="color: #fff; border-bottom: 2px solid #00f3ff; display: inline-block; padding-bottom: 3px; margin-bottom: 15px; font-size: 1.1rem;">
                    Yorumlar (<?php echo count($comments); ?>)
                </h4>

                <!-- YORUM LİSTESİ -->
                <div class="comment-section">
                    <?php if (empty($comments)): ?>
                        <p style="color:#666; font-style: italic; font-size: 0.9rem;">Henüz yorum yapılmamış. İlk yorumu sen yap!</p>
                    <?php else: ?>
                        <?php foreach($comments as $c): ?>
                            <div class="comment-card">
                                <div class="comment-header">
                                    <span class="comment-author"><?php echo htmlspecialchars($c['username']); ?></span>
                                    <span class="comment-date"><?php echo date('d.m.Y H:i', strtotime($c['created_at'])); ?></span>
                                </div>
                                <p class="comment-content"><?php echo nl2br(htmlspecialchars($c['content'])); ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>

                <!-- YORUM FORMU -->
                <div style="margin-top: 30px; background: #111; padding: 20px; border-radius: 10px; border: 1px solid #333;">
                    <?php if(!empty($error_msg)): ?>
                        <div class="alert-error"><?php echo $error_msg; ?></div>
                    <?php endif; ?>

                    <?php if(isset($_SESSION['user_id'])): ?>
                        <h5 style="color: #fff; margin-bottom: 10px; font-size: 1rem;">Cevap Yaz</h5>
                        <form method="POST" action="<?php echo BASE_URL; ?>/index.php/blog/details?id=<?php echo $topic_id; ?>&lang=<?php echo $lang; ?>">
                            <textarea name="comment" style="width:100%; background:#1e1e1e; color:#fff; border:1px solid #444; padding:10px; border-radius:6px; font-family:inherit; font-size: 0.9rem;" rows="3" placeholder="Düşüncelerini paylaş..." required></textarea>
                            <br><br>
                            <button type="submit" class="submit-btn" style="background: #00f3ff; color: #000; border: none; padding: 8px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 0.9rem;">
                                Yorumu Gönder
                            </button>
                        </form>
                    <?php else: ?>
                        <div style="text-align: center; padding: 10px;">
                            <p style="color:#888; margin-bottom: 10px; font-size: 0.9rem;">Bu tartışmaya katılmak için giriş yapmalısınız.</p>
                            <a href="<?php echo BASE_URL; ?>/index.php/login" class="btn" style="border: 1px solid #00f3ff; color: #00f3ff; padding: 5px 15px; border-radius: 4px; text-decoration: none; font-size: 0.8rem;">Giriş Yap</a>
                        </div>
                    <?php endif; ?>
                </div>

            <?php else: ?>
                <!-- KONU BULUNAMADI -->
                <div style="text-align:center; margin-top:50px; color: #666;">
                    <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 15px;"></i>
                    <h2>Konu Bulunamadı</h2>
                    <p>Aradığınız konu silinmiş veya mevcut değil.</p>
                </div>
            <?php endif; ?>

        </div>
    </section>

<?php include APP_PATH . '/views/partials/footer.php'; ?>