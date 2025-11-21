<!DOCTYPE html>
<html lang="<?php echo isset($lang) ? $lang : 'tr'; ?>">
<head>
    <meta charset="UTF-8">
    <!-- Mobil uyumluluk için kritik satır -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>Fikret | DevOps Engineer</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Fira+Code&display=swap" rel="stylesheet">
    <!-- İkon Seti -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Vanta.js Kütüphaneleri -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanta/0.5.24/vanta.halo.min.js"></script>

    <!-- TÜM CSS BURAYA GÖMÜLDÜ (DOSYA ÇAĞIRMA HATASINI ÖNLEMEK İÇİN) -->
    <style>
        /* 1. TEMEL SIFIRLAMA */
        :root {
            --bg-color: #0d0d0d;
            --text-main: #e0e0e0;
            --accent-color: #00f3ff;
            --nav-bg: rgba(13, 13, 13, 0.95);
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            width: 100%;
            overflow-x: hidden; /* Yatay taşmayı engelle */
            background-color: var(--bg-color);
            color: var(--text-main); /* Yazıları Beyaz Yap */
            font-family: 'Inter', sans-serif;
        }

        /* 2. ARKA PLAN (VANTA) */
        #vanta-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            z-index: -1; /* Her şeyin arkasına at */
            pointer-events: none; /* Tıklamaları engelleme! */
        }

        /* 3. NAVBAR (MENÜ) */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--nav-bg);
            backdrop-filter: blur(10px);
            z-index: 9999; /* En üstte olsun */
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .logo {
            font-size: 1.4rem;
            font-weight: bold;
            color: var(--accent-color);
            text-decoration: none;
        }

        /* Menü Linkleri (Noktaları Kaldır) */
        .nav-links {
            list-style: none; /* Mermileri yok et */
            display: flex;
            gap: 25px;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            font-size: 0.9rem;
            color: #aaa;
            text-decoration: none; /* Alt çizgiyi kaldır */
            transition: 0.3s;
        }

        .nav-links a:hover { color: var(--accent-color); }

        .hamburger { display: none; }

        /* 4. HERO SECTION */
        .hero {
            position: relative;
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 80px 20px 20px 20px;
            z-index: 10; /* Arka planın üzerinde olsun */
        }

        .hero-container {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h1 {
            font-size: 4rem;
            line-height: 1.1;
            margin-bottom: 10px;
            color: white;
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        .hero h2 {
            font-size: 2rem;
            color: #a0a0a0;
            margin-bottom: 20px;
        }

        .hero-desc { color: #ccc; margin-bottom: 40px; font-size: 1.2rem; }

        .hero-btns { display: flex; gap: 20px; justify-content: center; }

        .btn {
            padding: 15px 35px;
            border-radius: 30px;
            font-weight: bold;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary {
            background: #00f3ff;
            color: #000;
            box-shadow: 0 0 30px rgba(0, 243, 255, 0.3);
        }

        .btn-secondary {
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
        }

        /* 5. MOBİL GÖRÜNÜM */
        @media screen and (max-width: 768px) {
            .hamburger {
                display: block;
                font-size: 1.8rem;
                color: white;
                cursor: pointer;
                z-index: 10001;
            }

            .nav-links {
                position: fixed;
                top: 0;
                right: 0;
                width: 100%;
                height: 100vh;
                background: rgba(0, 0, 0, 0.98);
                flex-direction: column;
                justify-content: center;
                align-items: center;
                gap: 30px;
                transform: translateX(100%); /* Gizle */
                transition: transform 0.3s ease-in-out;
                z-index: 10000;
            }

            .nav-links.active { transform: translateX(0); /* Göster */ }
            .nav-links a { font-size: 1.5rem; color: white; }

            .hero h1 { font-size: 2.5rem; }
            .hero-btns { flex-direction: column; gap: 15px; width: 100%; }
            .btn { width: 100%; display: block; text-align: center; }
        }
    </style>
</head>
<body>