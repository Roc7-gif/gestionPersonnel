<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La ROUR 2026 | Événement Culturel et Artistique</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700;800&display=swap">
    <!-- Styles de base pour le layout -->
<style>
        :root {
            --primary-color: #e91e63;
            --primary-dark: #c2185b;
            --secondary-color: #9c27b0;
            --dark-color: #1a1a2e;
            --light-gray: #f5f5f7;
            --medium-gray: #8a8a9e;
            --white: #ffffff;
            --shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: var(--white);
            overflow-x: hidden;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        #header {
            background-color: var(--white);
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: var(--transition);
        }

        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-img {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            font-size: 24px;
        }

        .logo-text h1 {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 800;
            color: var(--dark-color);
            line-height: 1.2;
        }

        .logo-text p {
            font-size: 14px;
            color: var(--primary-color);
            font-weight: 500;
        }

        /* Navigation */
        .nav-links {
            display: flex;
            gap: 30px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--dark-color);
            font-weight: 500;
            font-size: 16px;
            position: relative;
            padding: 5px 0;
            transition: var(--transition);
        }

        .nav-links a:hover {
            color: var(--primary-color);
        }

        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-links a:hover::after {
            width: 100%;
        }

        /* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--dark-color);
            cursor: pointer;
            padding: 5px;
        }

        /* Main Content */
        main {
            min-height: 70vh;
        }

        /* Footer */
        footer {
            background-color: var(--dark-color);
            color: var(--white);
            padding: 60px 0 20px;
            margin-top: 80px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-section h3 {
            font-size: 20px;
            margin-bottom: 20px;
            color: var(--white);
            position: relative;
            padding-bottom: 10px;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 3px;
            background-color: var(--primary-color);
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 12px;
        }

        .footer-links a, .footer-links li {
            color: var(--light-gray);
            text-decoration: none;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .footer-links a:hover {
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: var(--white);
            font-size: 18px;
            transition: var(--transition);
        }

        .social-link:hover {
            background-color: var(--primary-color);
            transform: translateY(-5px);
        }

        .copyright {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--medium-gray);
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .nav-links {
                position: fixed;
                top: 90px;
                left: 0;
                width: 100%;
                background-color: var(--white);
                flex-direction: column;
                align-items: center;
                padding: 20px 0;
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
                transform: translateY(-100%);
                opacity: 0;
                visibility: hidden;
                transition: var(--transition);
                z-index: 999;
            }

            .nav-links.active {
                transform: translateY(0);
                opacity: 1;
                visibility: visible;
            }

            .nav-links a {
                padding: 10px 0;
                font-size: 18px;
            }

            .header-content {
                padding: 12px 0;
            }

            .logo-img {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }

            .logo-text h1 {
                font-size: 22px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }
</style>
</head>

<body>
    @yield('style')

    <header id="header">
        <div class="container header-content">
            <div class="logo">
                <div class="logo-img">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="logo-text">
                    <h1>La ROUR</h1>
                    <p>Édition 2026</p>
                </div>
            </div>

            <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Menu mobile">
                <i class="fas fa-bars"></i>
            </button>

           
        </div>
    </header>

    <main>
        @yield('body')
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3 class="footer-title">La ROUR</h3>
                    <p style="color: var(--light-gray); margin-bottom: 15px;">
                        Événement culturel et artistique annuel célébrant l'amour, le talent et la créativité.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">Liens rapides</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Accueil</a></li>
                        <li><a href="#voter">Voter maintenant</a></li>
                        <li><a href="#acheter">Acheter un ticket</a></li>
                        <li><a href="#nominés">Voir les nominés</a></li>
                        <li><a href="#infos">Infos évènement</a></li>
                    </ul>
                </div>

                <div class="footer-section">
                    <h3 class="footer-title">Contact</h3>
                    <ul class="footer-links">
                        <li><a href="mailto:nexusdynamics14@gmail.com"><i class="fas fa-envelope"></i> nexusdynamics14@gmail.com</a></li>
                        <li><a href="https://wa.me/2290140465038"><i class="fab fa-whatsapp"></i> +229 01 40 46 50 38</a></li>
                        <li><i class="fas fa-map-marker-alt"></i> Lokossa, Bénin</li>
                        <li><i class="fas fa-calendar-alt"></i> 12-14 Février 2026</li>
                    </ul>
                </div>
            </div>

            <div class="copyright">
                <p>&copy; 2025 La ROUR. Tous droits réservés. | Conception: Nexus Dynamics</p>
            </div>
        </div>
    </footer>

    <!-- Script pour le menu mobile -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const navLinks = document.getElementById('navLinks');
            
            // Toggle menu mobile
            mobileMenuBtn.addEventListener('click', function() {
                navLinks.classList.toggle('active');
                const icon = mobileMenuBtn.querySelector('i');
                
                if (navLinks.classList.contains('active')) {
                    icon.classList.remove('fa-bars');
                    icon.classList.add('fa-times');
                    document.body.style.overflow = 'hidden';
                } else {
                    icon.classList.remove('fa-times');
                    icon.classList.add('fa-bars');
                    document.body.style.overflow = 'auto';
                }
            });
            
            // Fermer le menu au clic sur un lien
            const navItems = navLinks.querySelectorAll('a');
            navItems.forEach(item => {
                item.addEventListener('click', function() {
                    navLinks.classList.remove('active');
                    mobileMenuBtn.querySelector('i').classList.remove('fa-times');
                    mobileMenuBtn.querySelector('i').classList.add('fa-bars');
                    document.body.style.overflow = 'auto';
                });
            });
            
            // Header scroll effect
            window.addEventListener('scroll', function() {
                const header = document.getElementById('header');
                if (window.scrollY > 100) {
                    header.style.padding = '5px 0';
                    header.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.1)';
                } else {
                    header.style.padding = '15px 0';
                    header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
                }
            });
        });
    </script>

    @yield('script')
</body>

</html>