<?php
// NOT: Config ve değişkenler ($t, $lang) Router tarafından yüklendi.

// Header ve Navbar'ı doğru yoldan çağırıyoruz
include APP_PATH . '/views/partials/header.php';
include APP_PATH . '/views/partials/navbar.php';

// VERİTABANI BAĞLANTISI KONTROLÜ (Eğer Router yükleyemediyse burada yükle)
if (!isset($conn) && file_exists(APP_PATH . '/config/db.php')) {
    include APP_PATH . '/config/db.php';
}

// KATEGORİLERİ ÇEK
$categories = []; // Varsayılan boş dizi
if (isset($conn)) {
    try {
        $cats_stmt = $conn->query("SELECT * FROM categories");
        if ($cats_stmt) {
            $categories = $cats_stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        // Hata olursa sessizce geç veya logla
        // echo "Kategori hatası: " . $e->getMessage();
    }
}

// KONULARI ÇEK
$topics = []; // Varsayılan boş dizi
if (isset($conn)) {
    try {
        $sql = "SELECT t.*, u.username, c.name as cat_name, 
                (SELECT COUNT(*) FROM comments WHERE topic_id = t.id) as reply_count 
                FROM topics t 
                JOIN users u ON t.user_id = u.id 
                JOIN categories c ON t.category_id = c.id 
                ORDER BY t.created_at DESC";
        $stmt = $conn->query($sql);
        if ($stmt) {
            $topics = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        // Hata olursa sessizce geç
    }
}
?>

    <style>
        .blog-container { display: grid; grid-template-columns: 250px 1fr; gap: 30px; margin-top: 40px; }
        .sidebar { background: #161616; padding: 20px; border-radius: 12px; height: fit-content; }
        .topic-card { background: #161616; padding: 25px; border-radius: 12px; margin-bottom: 20px; border-left: 4px solid transparent; transition: 0.3s; }
        .topic-card:hover { border-left-color: #00f3ff; transform: translateX(5px); }
        .topic-badge { background: rgba(0, 243, 255, 0.1); color: #00f3ff; padding: 2px 8px; border-radius: 4px; margin-right: 10px; }
        .create-btn { width: 100%; text-align: center; margin-bottom: 20px; display: block; }
        @media (max-width: 768px) { .blog-container { grid-template-columns: 1fr; } }
    </style>

    <section>
        <h2 class="section-title"><span>04.</span> Community Blog</h2>

        <div class="blog-container">
            <!-- SIDEBAR -->
            <aside class="sidebar">
                <!-- Giriş Kontrolü -->
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="<?php echo BASE_URL; ?>/index.php/blog/create?lang=<?php echo $lang; ?>" class="btn create-btn">+ Yeni Konu Aç</a>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>/index.php/login" class="btn create-btn" style="border-color:#555; color:#aaa;">Giriş Yaparak Konu Aç</a>
                <?php endif; ?>

                <h3 style="color:#00f3ff; margin-bottom:15px;">Kategoriler</h3>
                <ul class="cat-list" style="list-style:none; padding:0; color:#aaa;">
                    <?php if(empty($categories)): ?>
                        <li>Kategori bulunamadı.</li>
                    <?php else: ?>
                        <?php foreach($categories as $cat): ?>
                            <li style="margin-bottom:5px; cursor:pointer;">📂 <?php echo htmlspecialchars($cat['name']); ?></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </aside>

            <!-- MAIN CONTENT -->
            <div class="topic-list">
                <?php if(empty($topics)): ?>
                    <p style="color:#888; text-align:center;">Henüz hiç konu açılmamış. İlk yazan sen ol!</p>
                <?php else: ?>
                    <?php foreach($topics as $topic): ?>
                        <div class="topic-card">
                            <div class="topic-meta" style="font-size:0.8rem; color:#666; margin-bottom:10px;">
                                <span class="topic-badge"><?php echo htmlspecialchars($topic['cat_name']); ?></span>
                                <span style="float: right;">📅 <?php echo date('d.m.Y', strtotime($topic['created_at'])); ?> | 💬 <?php echo $topic['reply_count']; ?></span>
                            </div>
                            <h3 style="margin-bottom:5px;">
                                <!-- Link yapısı düzeltildi -->
                                <a href="<?php echo BASE_URL; ?>/index.php/blog/details?id=<?php echo $topic['id']; ?>&lang=<?php echo $lang; ?>" style="text-decoration:none; color:inherit;">
                                    <?php echo htmlspecialchars($topic['title']); ?>
                                </a>
                            </h3>
                            <p style="font-size: 0.9rem; color: #aaa;">
                                Yazar: <span style="color: #fff;"><?php echo htmlspecialchars($topic['username']); ?></span>
                            </p>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php
// Footer'ı doğru yoldan çağırıyoruz
include APP_PATH . '/views/partials/footer.php';
?>