<?php include APP_PATH . '/views/partials/header.php'; ?>
<?php include APP_PATH . '/views/partials/navbar.php'; ?>

<div class="contact-wrapper">
    <h2 style="text-align: center; color: #00f3ff; margin-bottom: 30px;">İletişime Geç</h2>
    <p style="text-align: center; color: #aaa; margin-bottom: 40px;">
        Yeni fırsatlara açığım. Bir sorunuz varsa veya sadece merhaba demek isterseniz formu doldurun.
    </p>

    <form action="" method="POST">
        <div class="form-group">
            <label>Adınız</label>
            <input type="text" name="name" class="form-control" placeholder="Adınızı giriniz" required>
        </div>

        <div class="form-group">
            <label>E-posta Adresiniz</label>
            <input type="email" name="email" class="form-control" placeholder="ornek@mail.com" required>
        </div>

        <div class="form-group">
            <label>Mesajınız</label>
            <textarea name="message" class="form-control" rows="5" placeholder="Mesajınızı buraya yazın..." required></textarea>
        </div>

        <button type="submit" class="btn-submit">Gönder 🚀</button>
    </form>
</div>

<?php include APP_PATH . '/views/partials/footer.php'; ?>
```
