<?php
// Docker ortam değişkenleri varsa onları kullan, yoksa localhost'a (XAMPP) bağlan
$servername = getenv('DB_HOST') ?: "localhost";
$dbname = getenv('DB_NAME') ?: "portfolio_db";
$username = getenv('DB_USER') ?: "fikret";
$password = getenv('DB_PASS') ?: "12345";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    // Hata modunu aç
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // Hata mesajını gizle (Güvenlik)
    die("Veritabanı bağlantı hatası. Lütfen daha sonra tekrar deneyin.");
}
?>