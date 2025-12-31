@extends('layout')

@section('style')
<style>
    /* Styles spécifiques à la page d'accueil */
    .hero {
        background: linear-gradient(rgba(26, 26, 46, 0.8), rgba(233, 30, 99, 0.2)),
            url('https://images.unsplash.com/photo-1511795409834-ef04bbd61622?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        background-size: cover;
        background-position: center;
        color: var(--white);
        padding: 150px 0 100px;
        text-align: center;
        margin-top: 0;
    }

    .hero-content {
        max-width: 800px;
        margin: 0 auto;
        animation: fadeInUp 0.8s ease forwards;
    }

    .hero h2 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .hero p {
        font-size: 1.2rem;
        margin-bottom: 40px;
        opacity: 0.9;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 15px 35px;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 10px;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: var(--white);
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(233, 30, 99, 0.4);
    }

    .btn-secondary {
        background-color: var(--white);
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
    }

    .btn-secondary:hover {
        background-color: var(--primary-color);
        color: var(--white);
        transform: translateY(-3px);
    }

    /* Section Statistiques */
    .stats {
        padding: 80px 0;
        background-color: var(--light-gray);
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 30px;
        text-align: center;
    }

    .stat-item {
        padding: 30px;
        background: var(--white);
        border-radius: 15px;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .stat-item:hover {
        transform: translateY(-10px);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 10px;
        display: block;
    }

    .stat-label {
        font-size: 1.1rem;
        color: var(--dark-color);
        font-weight: 500;
    }

    /* Section Catégories */
    .categories {
        padding: 80px 0;
    }

    .section-title {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        color: var(--dark-color);
        margin-bottom: 15px;
    }

    .section-title p {
        color: var(--medium-gray);
        max-width: 600px;
        margin: 0 auto;
    }

    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .category-card {
        background: var(--white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .category-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .category-icon {
        height: 100px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--white);
        font-size: 40px;
    }

    .category-content {
        padding: 25px;
    }

    .category-content h3 {
        font-size: 1.3rem;
        margin-bottom: 10px;
        color: var(--dark-color);
    }

    .category-content p {
        color: var(--medium-gray);
        font-size: 0.95rem;
        margin-bottom: 15px;
    }

    /* Section Date et Lieu */
    .event-info {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--dark-color), #2d2d44);
        color: var(--white);
    }

    .info-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 40px;
        align-items: center;
    }

    .info-card {
        text-align: center;
        padding: 40px 30px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 15px;
        backdrop-filter: blur(10px);
        transition: var(--transition);
    }

    .info-card:hover {
        transform: scale(1.05);
        background: rgba(255, 255, 255, 0.15);
    }

    .info-icon {
        font-size: 50px;
        margin-bottom: 20px;
        color: var(--primary-color);
    }

    .info-card h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
    }

    /* Section Sponsors */
    .sponsors {
        padding: 80px 0;
        background-color: var(--light-gray);
    }

    .sponsors-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 30px;
        align-items: center;
    }

    .sponsor-item {
        background: var(--white);
        padding: 30px;
        border-radius: 10px;
        text-align: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
    }

    .sponsor-item:hover {
        transform: scale(1.05);
    }

    .sponsor-icon {
        font-size: 40px;
        color: var(--primary-color);
        margin-bottom: 15px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero {
            padding: 120px 0 80px;
        }

        .hero h2 {
            font-size: 2.5rem;
        }

        .hero p {
            font-size: 1rem;
        }

        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }

        .btn {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }

        .stat-number {
            font-size: 2.5rem;
        }

        .section-title h2 {
            font-size: 2rem;
        }
    }

    @media (max-width: 480px) {
        .hero h2 {
            font-size: 2rem;
        }

        .stats-container,
        .categories-grid,
        .info-container,
        .sponsors-grid {
            grid-template-columns: 1fr;
        }

        .stat-item,
        .category-card,
        .info-card,
        .sponsor-item {
            padding: 20px;
        }
    }
</style>
@endsection

@section('body')
<!-- Section Hero -->
<section class="hero" id="home">
    <div class="container hero-content">
        <h2>La ROUR 2026</h2>
        <p>L'événement culturel et artistique le plus attendu de l'année. Célébrez avec nous l'amour, le talent et la créativité lors de cette édition exceptionnelle.</p>
        <div class="cta-buttons">
            <a href="#voter" class="btn btn-primary">
                <i class="fas fa-vote-yea"></i> Voter maintenant
            </a>
            <a href="#acheter" class="btn btn-secondary">
                <i class="fas fa-ticket-alt"></i> Acheter un ticket
            </a>
        </div>
    </div>
</section>

<!-- Section Statistiques -->
<section class="stats">
    <div class="container">
        <div class="stats-container">
            <div class="stat-item fade-in-up">
                <span class="stat-number" data-count="150">0</span>
                <span class="stat-label">Artistes Nominés</span>
            </div>
            <div class="stat-item fade-in-up" style="animation-delay: 0.2s">
                <span class="stat-number" data-count="25">0</span>
                <span class="stat-label">Catégories</span>
            </div>
            <div class="stat-item fade-in-up" style="animation-delay: 0.4s">
                <span class="stat-number" data-count="3">0</span>
                <span class="stat-label">Jours d'Événement</span>
            </div>
            <div class="stat-item fade-in-up" style="animation-delay: 0.6s">
                <span class="stat-number" data-count="5000">0</span>
                <span class="stat-label">Participants Attendus</span>
            </div>
        </div>
    </div>
</section>

<!-- Section Catégories -->
<section class="categories" id="nominés">
    <div class="container">
        <div class="section-title">
            <h2>Catégories Principales</h2>
            <p>Découvrez les différentes catégories dans lesquelles les artistes seront récompensés</p>
        </div>
        <div class="categories-grid">
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-music"></i>
                </div>
                <div class="category-content">
                    <h3>Musique</h3>
                    <p>Récompense les meilleurs talents musicaux de l'année dans diverses catégories</p>
                    <a href="#nominés" class="btn btn-secondary" style="padding: 10px 20px; font-size: 0.9rem;">
                        Voir les nominés
                    </a>
                </div>
            </div>
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-film"></i>
                </div>
                <div class="category-content">
                    <h3>Cinéma & Théâtre</h3>
                    <p>Célébration des performances exceptionnelles dans le cinéma et le théâtre</p>
                    <a href="#nominés" class="btn btn-secondary" style="padding: 10px 20px; font-size: 0.9rem;">
                        Voir les nominés
                    </a>
                </div>
            </div>
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-paint-brush"></i>
                </div>
                <div class="category-content">
                    <h3>Arts Visuels</h3>
                    <p>Reconnaissance des artistes en peinture, sculpture, photographie et design</p>
                    <a href="#nominés" class="btn btn-secondary" style="padding: 10px 20px; font-size: 0.9rem;">
                        Voir les nominés
                    </a>
                </div>
            </div>
            <div class="category-card">
                <div class="category-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <div class="category-content">
                    <h3>Prix Spécial "Cœur d'Or"</h3>
                    <p>Récompense l'engagement social et humanitaire à travers l'art</p>
                    <a href="#nominés" class="btn btn-secondary" style="padding: 10px 20px; font-size: 0.9rem;">
                        Voir les nominés
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Date et Lieu -->
<section class="event-info" id="infos">
    <div class="container">
        <div class="section-title" style="color: var(--white);">
            <h2>Informations Pratiques</h2>
            <p>Tout ce que vous devez savoir pour participer à l'événement</p>
        </div>
        <div class="info-container">
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Dates</h3>
                <p>12, 13 & 14 Février 2026</p>
                <p>De 18h00 à Minuit</p>
            </div>
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3>Lieu</h3>
                <p>Palais des Congrès</p>
                <p>Lokossa, Bénin</p>
            </div>
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <h3>Billets</h3>
                <p>À partir de 10.000 FCFA</p>
                <p>Pass 3 jours: 25.000 FCFA</p>
            </div>
            <div class="info-card">
                <div class="info-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Programme</h3>
                <p>Cérémonies • Concerts • Expositions</p>
                <p>Workshops • Réseautage</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Sponsors -->
<section class="sponsors">
    <div class="container">
        <div class="section-title">
            <h2>Nos Partenaires</h2>
            <p>Des entreprises qui soutiennent la culture et l'art</p>
        </div>
        <div class="sponsors-grid">
            <div class="sponsor-item">
                <div class="sponsor-icon">
                    <i class="fas fa-star"></i>
                </div>
                <h4>Arts Premium</h4>
            </div>
            <div class="sponsor-item">
                <div class="sponsor-icon">
                    <i class="fas fa-globe-africa"></i>
                </div>
                <h4>Culture Bénin</h4>
            </div>
            <div class="sponsor-item">
                <div class="sponsor-icon">
                    <i class="fas fa-music"></i>
                </div>
                <h4>Son Excellence</h4>
            </div>
            <div class="sponsor-item">
                <div class="sponsor-icon">
                    <i class="fas fa-palette"></i>
                </div>
                <h4>Art Vision</h4>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des statistiques
        const statNumbers = document.querySelectorAll('.stat-number');

        const animateStats = () => {
            statNumbers.forEach(stat => {
                const target = parseInt(stat.getAttribute('data-count'));
                const duration = 2000; // 2 secondes
                const step = target / (duration / 16); // 60fps
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        stat.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(current).toLocaleString();
                    }
                }, 16);
            });
        };

        // Observer pour l'animation des statistiques
        const statsSection = document.querySelector('.stats');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateStats();
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.5
        });

        observer.observe(statsSection);

        // Animation des cartes au scroll
        const fadeElements = document.querySelectorAll('.fade-in-up');

        const fadeObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                    fadeObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });

        fadeElements.forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            fadeObserver.observe(element);
        });

        // Smooth scroll pour les ancres
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                const targetId = this.getAttribute('href');
                if (targetId === '#') return;

                const targetElement = document.querySelector(targetId);
                if (targetElement) {
                    const headerHeight = document.getElementById('header').offsetHeight;
                    const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - headerHeight;

                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Gestion du formulaire d'achat de tickets
        
    });
</script>
@endsection