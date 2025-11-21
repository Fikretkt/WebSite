<?php
// URL'den dili al, geçerli değilse 'tr' yap
$valid_langs = ['tr', 'en', 'de'];
$lang = isset($_GET['lang']) && in_array($_GET['lang'], $valid_langs) ? $_GET['lang'] : 'tr';

// Şu anki sayfanın adını al (Linkleri düzgün oluşturmak için)
$currentPage = basename($_SERVER['PHP_SELF']);

// --- DİL SÖZLÜĞÜ (TÜM KELİMELER) ---
$translations = [
    'tr' => [
        // Menü Linkleri
        'nav_home' => 'Ana Sayfa',
        'nav_about' => 'Hakkımda',
        'nav_projects' => 'Projeler',
        'nav_blog' => 'Blog / Forum', // YENİ
        'nav_contact' => 'İletişim',

        // Ana Sayfa (Hero) Metinleri
        'hero_greeting' => 'Merhaba, benim adım',
        'hero_title' => 'DevOps Engineer & Cloud Enthusiast',
        'hero_desc' => 'Ölçeklenebilir altyapılar tasarlıyor, dağıtım süreçlerini otomatikleştiriyor ve bulutta sorunsuz sistemler inşa ediyorum.',
        'btn_projects' => 'Projelerimi İncele',

        // İletişim Sayfası Metinleri
        'contact_title' => 'İletişime Geç',
        'contact_desc' => 'Yeni fırsatlara açığım. Bir sorunuz varsa veya merhaba demek isterseniz yazabilirsiniz!',
        'form_name' => 'Adınız',
        'form_email' => 'E-posta Adresiniz',
        'form_msg' => 'Mesajınız',
        'btn_send' => 'Gönder',
        'msg_success' => 'Mesaj alındı, teşekkürler!',

        // Dil Değiştirme Butonu
        'next_lang_code' => 'EN',
        'next_lang_link' => "?lang=en"
    ],
    'en' => [
        // Menu Links
        'nav_home' => 'Home',
        'nav_about' => 'About Me',
        'nav_projects' => 'Projects',
        'nav_blog' => 'Blog / Forum', // NEW
        'nav_contact' => 'Contact',

        // Hero Text
        'hero_greeting' => 'Hi, my name is',
        'hero_title' => 'DevOps Engineer & Cloud Enthusiast',
        'hero_desc' => 'I design scalable infrastructures, automate deployment processes, and build seamless systems in the cloud.',
        'btn_projects' => 'View My Work',

        // Contact Page Text
        'contact_title' => 'Get In Touch',
        'contact_desc' => 'I am open to new opportunities. Whether you have a question or just want to say hi, my inbox is open!',
        'form_name' => 'Your Name',
        'form_email' => 'Your Email',
        'form_msg' => 'Your Message',
        'btn_send' => 'Send Message',
        'msg_success' => 'Message received, thanks!',

        // Lang Switch
        'next_lang_code' => 'DE',
        'next_lang_link' => "?lang=de"
    ],
    'de' => [
        // Menü Links
        'nav_home' => 'Startseite',
        'nav_about' => 'Über Mich',
        'nav_projects' => 'Projekte',
        'nav_blog' => 'Blog / Forum', // NEU
        'nav_contact' => 'Kontakt',

        // Hero Text
        'hero_greeting' => 'Hallo, mein Name ist',
        'hero_title' => 'DevOps Engineer & Cloud Enthusiast',
        'hero_desc' => 'Ich entwerfe skalierbare Infrastrukturen, automatisiere Bereitstellungsprozesse und baue nahtlose Systeme in der Cloud.',
        'btn_projects' => 'Meine Arbeit ansehen',

        // Kontaktseite Text
        'contact_title' => 'Kontakt aufnehmen',
        'contact_desc' => 'Ich bin offen für neue Möglichkeiten. Ob Sie eine Frage haben oder einfach nur Hallo sagen wollen, mein Posteingang ist offen!',
        'form_name' => 'Ihr Name',
        'form_email' => 'Ihre E-Mail-Adresse',
        'form_msg' => 'Ihre Nachricht',
        'btn_send' => 'Senden',
        'msg_success' => 'Nachricht erhalten, danke!',

        // Lang Switch
        'next_lang_code' => 'TR',
        'next_lang_link' => "?lang=tr"
    ]
];

// Seçilen dili aktif et
$t = $translations[$lang];
?>