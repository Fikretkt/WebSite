<?php include APP_PATH . '/views/partials/header.php'; ?>
<?php include APP_PATH . '/views/partials/navbar.php'; ?>

    <div class="contact-box">
        <div style="text-align: center; margin-bottom: 40px;">
            <h2 style="color: #00f3ff; font-size: 2rem; margin-bottom: 10px;">İletişime Geç</h2>
            <p style="color: #aaa;">Projeleriniz veya iş birliği için aşağıdaki formu doldurabilirsiniz.</p>
        </div>

        <form action="" method="POST">
            <div class="form-group">
                <label>Adınız Soyadınız</label>
                <input type="text" name="name" class="form-input" placeholder="Örn: Ahmet Yılmaz" required>
            </div>

            <div class="form-group">
                <label>E-posta Adresiniz</label>
                <input type="email" name="email" class="form-input" placeholder="ornek@sirket.com" required>
            </div>

            <div class="form-group">
                <label>Mesajınız</label>
                <textarea name="message" class="form-input" rows="5" placeholder="Projenizden kısaca bahsedin..." required></textarea>
            </div>

            <button type="submit" class="btn-submit">
                <i class="fas fa-paper-plane"></i> Mesajı Gönder
            </button>
        </form>
    </div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>