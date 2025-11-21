-- Mevcut tabloları temizle (Temiz başlangıç)
DROP TABLE IF EXISTS comments;
DROP TABLE IF EXISTS topics;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS messages;
DROP TABLE IF EXISTS users;

-- 1. Kullanıcılar
CREATE TABLE users (
                       id INT AUTO_INCREMENT PRIMARY KEY,
                       username VARCHAR(50) NOT NULL UNIQUE,
                       email VARCHAR(100) NOT NULL UNIQUE,
                       password VARCHAR(255) NOT NULL,
                       role ENUM('user', 'admin') DEFAULT 'user',
                       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. Kategoriler
CREATE TABLE categories (
                            id INT AUTO_INCREMENT PRIMARY KEY,
                            name VARCHAR(50) NOT NULL
);

-- 3. Konular
CREATE TABLE topics (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        user_id INT NOT NULL,
                        category_id INT NOT NULL,
                        title VARCHAR(255) NOT NULL,
                        content TEXT NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        FOREIGN KEY (user_id) REFERENCES users(id),
                        FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- 4. Yorumlar
CREATE TABLE comments (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          topic_id INT NOT NULL,
                          user_id INT NOT NULL,
                          content TEXT NOT NULL,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                          FOREIGN KEY (topic_id) REFERENCES topics(id),
                          FOREIGN KEY (user_id) REFERENCES users(id)
);

-- 5. İletişim Mesajları
CREATE TABLE messages (
                          id INT AUTO_INCREMENT PRIMARY KEY,
                          name VARCHAR(100) NOT NULL,
                          email VARCHAR(100) NOT NULL,
                          message TEXT NOT NULL,
                          created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Varsayılan Veriler
INSERT INTO categories (name) VALUES ('Genel'), ('Linux'), ('Docker'), ('CLOUD'), ('PHP'), ('JAVASCRIPT'),('PYTHON');
-- Admin Kullanıcısı (Şifre: 12345)
INSERT INTO users (username, email, password, role) VALUES ('admin', 'admin@test.com', '$2y$10$X/wSjW.wQy.wQy.wQy.wQy.wQy.wQy.wQy.wQy.wQy.wQy', 'admin');