<!-- FOOTER -->
<footer style="background-color: #0d0d0d; padding: 40px 20px; text-align: center; border-top: 1px solid rgba(255,255,255,0.05); margin-top: auto;">
    <p style="color: #555; font-family: monospace; font-size: 0.9rem;">
        &copy; <?php echo date('Y'); ?> Fikret Kocatürk
    </p>
</footer>

<!-- MENÜ SCRİPTİ -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');
        const links = document.querySelectorAll('.nav-links li a');

        if (hamburger && navLinks) {
            // Tıklanınca AÇ / KAPA
            hamburger.addEventListener('click', () => {
                navLinks.classList.toggle('active');
            });
        }

        // Linke tıklanınca KAPAT
        links.forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active');
            });
        });
    });
</script>
</body>
</html>