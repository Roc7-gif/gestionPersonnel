@extends('layout')

@section('style')
<style>
    /* Styles spécifiques à la page Nominés */
    .page-hero {
        background: linear-gradient(rgba(26, 26, 46, 0.9), rgba(233, 30, 99, 0.3)), 
                    url('https://images.unsplash.com/photo-1511379938547-c1f69419868d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
        background-size: cover;
        background-position: center;
        color: var(--white);
        padding: 150px 0 80px;
        text-align: center;
        margin-top: 0;
    }

    .page-hero h1 {
        font-family: 'Playfair Display', serif;
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .page-hero p {
        font-size: 1.2rem;
        max-width: 700px;
        margin: 0 auto 30px;
        opacity: 0.9;
    }

    /* Filtres */
    .filters {
        padding: 40px 0;
        background-color: var(--light-gray);
        position: sticky;
        top: 90px;
        z-index: 999;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .filter-container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: center;
        align-items: center;
    }

    .search-box {
        position: relative;
        flex: 1;
        max-width: 400px;
        min-width: 250px;
    }

    .search-input {
        width: 100%;
        padding: 14px 20px 14px 45px;
        border: 2px solid #e0e0e7;
        border-radius: 50px;
        font-size: 1rem;
        transition: var(--transition);
        background-color: var(--white);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.1);
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--medium-gray);
    }

    .category-filter {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
    }

    .category-btn {
        padding: 10px 20px;
        background: var(--white);
        border: 2px solid #e0e0e7;
        color: var(--dark-color);
        border-radius: 50px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        font-size: 0.95rem;
        white-space: nowrap;
    }

    .category-btn.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.2);
    }

    .category-btn:hover:not(.active) {
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: translateY(-2px);
    }

    /* Section Nominés */
    .nomines {
        padding: 60px 0 80px;
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
        position: relative;
        display: inline-block;
    }

    .section-title h2::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 3px;
        background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    }

    .section-title p {
        color: var(--medium-gray);
        max-width: 600px;
        margin: 0 auto;
    }

    .nomine-count {
        text-align: center;
        margin-bottom: 30px;
        color: var(--medium-gray);
        font-size: 1.1rem;
    }

    .nomine-count span {
        color: var(--primary-color);
        font-weight: 600;
    }

    .nominees-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .nominee-card {
        background: var(--white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
    }

    .nominee-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .nominee-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        background: var(--primary-color);
        color: var(--white);
        padding: 5px 15px;
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 600;
        z-index: 2;
    }

    .nominee-media {
        height: 200px;
        overflow: hidden;
        position: relative;
    }

    .nominee-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .nominee-card:hover .nominee-media img {
        transform: scale(1.1);
    }

    .nominee-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        padding: 20px;
    }

    .nominee-card:hover .nominee-overlay {
        opacity: 1;
    }

    .overlay-btn {
        width: 40px;
        height: 40px;
        background: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary-color);
        text-decoration: none;
        transition: var(--transition);
        transform: translateY(20px);
        opacity: 0;
    }

    .nominee-card:hover .overlay-btn {
        transform: translateY(0);
        opacity: 1;
    }

    .overlay-btn:hover {
        background: var(--primary-color);
        color: var(--white);
        transform: scale(1.1);
    }

    .nominee-content {
        padding: 25px;
    }

    .nominee-category {
        display: inline-block;
        background: rgba(233, 30, 99, 0.1);
        color: var(--primary-color);
        padding: 5px 15px;
        border-radius: 5px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .nominee-name {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 10px;
        color: var(--dark-color);
    }

    .nominee-title {
        color: var(--medium-gray);
        font-size: 0.95rem;
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .nominee-stats {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .votes-count {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    .vote-btn {
        padding: 8px 20px;
        background: var(--primary-color);
        color: var(--white);
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .vote-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    .vote-btn.voted {
        background: var(--secondary-color);
    }

    .vote-btn.voted:hover {
        background: #7b1fa2;
    }

    /* Pagination */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-top: 50px;
    }

    .page-btn {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--white);
        border: 2px solid #e0e0e7;
        border-radius: 8px;
        color: var(--dark-color);
        text-decoration: none;
        font-weight: 600;
        transition: var(--transition);
    }

    .page-btn:hover,
    .page-btn.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--white);
    }

    .page-btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .page-btn.disabled:hover {
        background: var(--white);
        border-color: #e0e0e7;
        color: var(--dark-color);
    }

    .page-dots {
        color: var(--medium-gray);
        padding: 0 5px;
    }

    /* Section Statistiques de Vote */
    .vote-stats {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--dark-color), #2d2d44);
        color: var(--white);
    }

    .stats-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 30px;
        text-align: center;
        transition: var(--transition);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.15);
        border-color: var(--primary-color);
    }

    .stat-icon {
        font-size: 40px;
        margin-bottom: 20px;
        color: var(--primary-color);
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .stat-label {
        font-size: 1rem;
        opacity: 0.9;
    }

    /* Modal de Vote */
    .vote-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .vote-modal.active {
        display: flex;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        background: var(--white);
        border-radius: 15px;
        max-width: 500px;
        width: 100%;
        overflow: hidden;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from { transform: translateY(30px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }

    .modal-header {
        padding: 25px 30px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: var(--white);
        text-align: center;
    }

    .modal-header h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .modal-body {
        padding: 30px;
        text-align: center;
    }

    .modal-nominee {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
        padding-bottom: 25px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    }

    .modal-nominee img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        object-fit: cover;
    }

    .modal-nominee-info h4 {
        font-size: 1.3rem;
        margin-bottom: 5px;
        color: var(--dark-color);
        text-align: left;
    }

    .modal-nominee-info p {
        color: var(--medium-gray);
        text-align: left;
        font-size: 0.95rem;
    }

    .vote-confirm {
        background: rgba(76, 175, 80, 0.1);
        color: #4caf50;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 25px;
        text-align: left;
    }

    .vote-confirm h4 {
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .vote-confirm p {
        font-size: 0.9rem;
        margin-bottom: 10px;
    }

    .vote-confirm ul {
        text-align: left;
        padding-left: 20px;
        font-size: 0.9rem;
    }

    .modal-actions {
        display: flex;
        gap: 15px;
        margin-top: 25px;
    }

    .modal-btn {
        flex: 1;
        padding: 15px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        font-size: 1rem;
    }

    .modal-btn.confirm {
        background: var(--primary-color);
        color: var(--white);
    }

    .modal-btn.confirm:hover {
        background: var(--primary-dark);
    }

    .modal-btn.cancel {
        background: var(--light-gray);
        color: var(--dark-color);
    }

    .modal-btn.cancel:hover {
        background: #e0e0e7;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .page-hero h1 {
            font-size: 2.8rem;
        }

        .nominees-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        }
    }

    @media (max-width: 768px) {
        .page-hero {
            padding: 120px 0 60px;
        }

        .page-hero h1 {
            font-size: 2.2rem;
        }

        .filters {
            top: 80px;
            padding: 30px 0;
        }

        .filter-container {
            flex-direction: column;
            align-items: stretch;
        }

        .search-box {
            max-width: 100%;
        }

        .category-filter {
            justify-content: flex-start;
            overflow-x: auto;
            padding-bottom: 10px;
            -webkit-overflow-scrolling: touch;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .nominees-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }

        .modal-content {
            margin: 20px;
        }

        .modal-actions {
            flex-direction: column;
        }

        .stats-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 480px) {
        .page-hero h1 {
            font-size: 1.8rem;
        }

        .page-hero p {
            font-size: 1rem;
        }

        .nominee-content {
            padding: 20px;
        }

        .nominee-stats {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }

        .vote-btn {
            width: 100%;
            justify-content: center;
        }

        .modal-nominee {
            flex-direction: column;
            text-align: center;
        }

        .modal-nominee-info h4,
        .modal-nominee-info p {
            text-align: center;
        }
    }

    /* Animation pour les cartes */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-in {
        animation: fadeInUp 0.6s ease forwards;
    }
</style>
@endsection

@section('body')
<!-- Section Hero -->
<section class="page-hero" id="nominés">
    <div class="container">
        <h1>Les Nominés 2026</h1>
        <p>Découvrez les talents exceptionnels nominés pour La ROUR 2026. Votez pour vos favoris et participez à la célébration de l'excellence artistique.</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <a href="#voter" class="btn" style="padding: 12px 30px; background: var(--white); color: var(--primary-color); border-radius: 50px; text-decoration: none; font-weight: 600; transition: var(--transition);">
                <i class="fas fa-vote-yea"></i> Comment voter ?
            </a>
            <a href="#stats" class="btn" style="padding: 12px 30px; background: transparent; border: 2px solid var(--white); color: var(--white); border-radius: 50px; text-decoration: none; font-weight: 600; transition: var(--transition);">
                <i class="fas fa-chart-bar"></i> Voir les stats
            </a>
        </div>
    </div>
</section>

<!-- Filtres -->
<section class="filters">
    <div class="container">
        <div class="filter-container">
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="searchInput" class="search-input" placeholder="Rechercher un nominé...">
            </div>

            <div class="category-filter">
                <button class="category-btn active" data-category="all">Tous</button>
                <button class="category-btn" data-category="musique">Musique</button>
                <button class="category-btn" data-category="cinema">Cinéma & Théâtre</button>
                <button class="category-btn" data-category="arts">Arts Visuels</button>
                <button class="category-btn" data-category="special">Prix Spéciaux</button>
            </div>
        </div>
    </div>
</section>

<!-- Section Nominés -->
<section class="nomines">
    <div class="container">
        <div class="section-title">
            <h2>Découvrez les Talents</h2>
            <p>Explorez les différentes catégories et votez pour vos artistes préférés</p>
        </div>

        <div class="nomine-count">
            <span id="nomineeCount">24</span> nominés trouvés
        </div>

        <div class="nominees-grid" id="nomineesGrid">
            <!-- Les cartes des nominés seront générées dynamiquement par JavaScript -->
        </div>

        <!-- Pagination -->
        <div class="pagination" id="pagination">
            <!-- La pagination sera générée dynamiquement -->
        </div>
    </div>
</section>

<!-- Section Statistiques de Vote -->
<section class="vote-stats" id="stats">
    <div class="container">
        <div class="section-title" style="color: var(--white);">
            <h2>Statistiques de Vote</h2>
            <p>Suivez l'évolution des votes en temps réel</p>
        </div>

        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number" id="totalVotes">12,458</div>
                <div class="stat-label">Votes Totaux</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="stat-number" id="votersCount">3,842</div>
                <div class="stat-label">Votants Uniques</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-fire"></i>
                </div>
                <div class="stat-number" id="topCategory">Musique</div>
                <div class="stat-label">Catégorie la Plus Populaire</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number" id="daysLeft">42</div>
                <div class="stat-label">Jours Restants</div>
            </div>
        </div>
    </div>
</section>

<!-- Modal de Vote -->
<div class="vote-modal" id="voteModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Confirmer votre vote</h3>
            <p>Votre vote est important pour nos artistes</p>
        </div>
        <div class="modal-body">
            <div class="modal-nominee">
                <img id="modalNomineeImage" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Nominé">
                <div class="modal-nominee-info">
                    <h4 id="modalNomineeName">John Doe</h4>
                    <p id="modalNomineeCategory">Catégorie Musique</p>
                    <p id="modalNomineeTitle">Artiste de l'année</p>
                </div>
            </div>

            <div class="vote-confirm">
                <h4><i class="fas fa-info-circle"></i> Important :</h4>
                <p>Vous êtes sur le point de voter pour ce nominé. Notez que :</p>
                <ul>
                    <li>Vous ne pouvez voter qu'une seule fois par catégorie</li>
                    <li>Votre vote est définitif et ne peut être modifié</li>
                    <li>Vous devez être connecté pour voter</li>
                </ul>
            </div>

            <div class="modal-actions">
                <button class="modal-btn confirm" id="confirmVote">
                    <i class="fas fa-check"></i> Confirmer le vote
                </button>
                <button class="modal-btn cancel" id="cancelVote">
                    <i class="fas fa-times"></i> Annuler
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    // Données des nominés
    const nomineesData = [
        {
            id: 1,
            name: "Amina Diallo",
            category: "musique",
            categoryName: "Musique",
            title: "Chanteuse - Album 'Écho du Cœur'",
            votes: 1245,
            image: "https://randomuser.me/api/portraits/women/44.jpg",
            description: "Artiste complète, auteur-compositeur-interprète, révélation de l'année 2025.",
            featured: false
        },
        {
            id: 2,
            name: "Jean Koffi",
            category: "cinema",
            categoryName: "Cinéma & Théâtre",
            title: "Réalisateur - Film 'Les Ombres de la Ville'",
            votes: 892,
            image: "https://randomuser.me/api/portraits/men/32.jpg",
            description: "Visionnaire du cinéma africain contemporain.",
            featured: true
        },
        {
            id: 3,
            name: "Sarah Mensah",
            category: "arts",
            categoryName: "Arts Visuels",
            title: "Peintre - Collection 'Renaissance'",
            votes: 756,
            image: "https://randomuser.me/api/portraits/women/68.jpg",
            description: "Artiste plasticienne engagée pour l'environnement.",
            featured: false
        },
        {
            id: 4,
            name: "Dj Afro",
            category: "musique",
            categoryName: "Musique",
            title: "DJ/Producteur - Single 'Afro Fusion'",
            votes: 2103,
            image: "https://randomuser.me/api/portraits/men/75.jpg",
            description: "Pionnier de l'afro-house au Bénin.",
            featured: true
        },
        {
            id: 5,
            name: "Fatou N'Diaye",
            category: "cinema",
            categoryName: "Cinéma & Théâtre",
            title: "Actrice - Rôle dans 'L'Héritage'",
            votes: 934,
            image: "https://randomuser.me/api/portraits/women/26.jpg",
            description: "Performance remarquable dans un rôle dramatique.",
            featured: false
        },
        {
            id: 6,
            name: "Samuel Gnon",
            category: "special",
            categoryName: "Prix Spéciaux",
            title: "Mécène - Prix Cœur d'Or",
            votes: 567,
            image: "https://randomuser.me/api/portraits/men/55.jpg",
            description: "Engagement exceptionnel pour les jeunes artistes.",
            featured: false
        },
        {
            id: 7,
            name: "Étoile Mélodie",
            category: "musique",
            categoryName: "Musique",
            title: "Chanteuse - Hit 'African Dream'",
            votes: 1789,
            image: "https://randomuser.me/api/portraits/women/33.jpg",
            description: "Voice exceptionnelle, ambassadrice de la musique béninoise.",
            featured: true
        },
        {
            id: 8,
            name: "Pierre Agbodjin",
            category: "cinema",
            categoryName: "Cinéma & Théâtre",
            title: "Scénariste - Série 'Nouvelles Générations'",
            votes: 621,
            image: "https://randomuser.me/api/portraits/men/42.jpg",
            description: "Écriture contemporaine et engagée.",
            featured: false
        },
        {
            id: 9,
            name: "Léa Yayi",
            category: "arts",
            categoryName: "Arts Visuels",
            title: "Sculptrice - Installation 'Métamorphose'",
            votes: 432,
            image: "https://randomuser.me/api/portraits/women/51.jpg",
            description: "Travaille les matériaux recyclés avec brio.",
            featured: false
        },
        {
            id: 10,
            name: "Koffi Dan",
            category: "musique",
            categoryName: "Musique",
            title: "Musicien - Album instrumental 'Harmonie'",
            votes: 1107,
            image: "https://randomuser.me/api/portraits/men/28.jpg",
            description: "Virtuose du kora et compositeur talentueux.",
            featured: false
        },
        {
            id: 11,
            name: "Mariam Sékou",
            category: "special",
            categoryName: "Prix Spéciaux",
            title: "Éducatrice - Prix de l'Innovation Sociale",
            votes: 389,
            image: "https://randomuser.me/api/portraits/women/72.jpg",
            description: "Projet d'éducation artistique pour enfants défavorisés.",
            featured: false
        },
        {
            id: 12,
            name: "Black Afro",
            category: "musique",
            categoryName: "Musique",
            title: "Producteur - Label 'Afro Vibes'",
            votes: 1543,
            image: "https://randomuser.me/api/portraits/men/65.jpg",
            description: "Découverte de nombreux jeunes talents.",
            featured: true
        }
    ];

    document.addEventListener('DOMContentLoaded', function() {
        const nomineesGrid = document.getElementById('nomineesGrid');
        const searchInput = document.getElementById('searchInput');
        const categoryBtns = document.querySelectorAll('.category-btn');
        const nomineeCount = document.getElementById('nomineeCount');
        const pagination = document.getElementById('pagination');
        const voteModal = document.getElementById('voteModal');
        const confirmVoteBtn = document.getElementById('confirmVote');
        const cancelVoteBtn = document.getElementById('cancelVote');

        let currentCategory = 'all';
        let currentSearch = '';
        let currentPage = 1;
        const nomineesPerPage = 6;
        let votedNominees = JSON.parse(localStorage.getItem('votedNominees') || '[]');
        let currentNomineeId = null;

        // Initialiser les statistiques
        updateStats();

        // Générer les cartes des nominés
        function renderNominees() {
            const filteredNominees = filterNominees();
            const totalPages = Math.ceil(filteredNominees.length / nomineesPerPage);
            const startIndex = (currentPage - 1) * nomineesPerPage;
            const endIndex = startIndex + nomineesPerPage;
            const pageNominees = filteredNominees.slice(startIndex, endIndex);

            nomineesGrid.innerHTML = '';
            nomineeCount.textContent = filteredNominees.length;

            if (pageNominees.length === 0) {
                nomineesGrid.innerHTML = `
                    <div style="grid-column: 1 / -1; text-align: center; padding: 60px; color: var(--medium-gray);">
                        <i class="fas fa-search" style="font-size: 50px; margin-bottom: 20px; color: var(--light-gray);"></i>
                        <h3 style="margin-bottom: 10px; color: var(--dark-color);">Aucun nominé trouvé</h3>
                        <p>Essayez de modifier vos critères de recherche ou de filtrage.</p>
                    </div>
                `;
                pagination.innerHTML = '';
                return;
            }

            pageNominees.forEach((nominee, index) => {
                const card = document.createElement('div');
                card.className = 'nominee-card fade-in';
                card.style.animationDelay = `${index * 0.1}s`;

                const hasVoted = votedNominees.includes(nominee.id);
                
                card.innerHTML = `
                    ${nominee.featured ? '<span class="nominee-badge">Coup de cœur</span>' : ''}
                    <div class="nominee-media">
                        <img src="${nominee.image}" alt="${nominee.name}" loading="lazy">
                        <div class="nominee-overlay">
                            <a href="#" class="overlay-btn" data-id="${nominee.id}" onclick="viewNominee(${nominee.id})">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" class="overlay-btn" data-id="${nominee.id}" onclick="shareNominee(${nominee.id})">
                                <i class="fas fa-share-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div class="nominee-content">
                        <span class="nominee-category">${nominee.categoryName}</span>
                        <h3 class="nominee-name">${nominee.name}</h3>
                        <p class="nominee-title">${nominee.title}</p>
                        <p style="color: var(--medium-gray); font-size: 0.9rem; margin-bottom: 15px;">${nominee.description}</p>
                        <div class="nominee-stats">
                            <div class="votes-count">
                                <i class="fas fa-heart"></i> ${nominee.votes.toLocaleString()} votes
                            </div>
                            <button class="vote-btn ${hasVoted ? 'voted' : ''}" 
                                    data-id="${nominee.id}"
                                    onclick="openVoteModal(${nominee.id})"
                                    ${hasVoted ? 'disabled' : ''}>
                                ${hasVoted ? '<i class="fas fa-check"></i> Déjà voté' : '<i class="fas fa-vote-yea"></i> Voter'}
                            </button>
                        </div>
                    </div>
                `;
                
                nomineesGrid.appendChild(card);
            });

            renderPagination(totalPages);
        }

        // Filtrer les nominés
        function filterNominees() {
            return nomineesData.filter(nominee => {
                const matchesCategory = currentCategory === 'all' || nominee.category === currentCategory;
                const matchesSearch = !currentSearch || 
                    nominee.name.toLowerCase().includes(currentSearch) ||
                    nominee.title.toLowerCase().includes(currentSearch) ||
                    nominee.description.toLowerCase().includes(currentSearch);
                return matchesCategory && matchesSearch;
            });
        }

        // Générer la pagination
        function renderPagination(totalPages) {
            if (totalPages <= 1) {
                pagination.innerHTML = '';
                return;
            }

            let paginationHTML = '';

            // Bouton précédent
            paginationHTML += `
                <a href="#" class="page-btn ${currentPage === 1 ? 'disabled' : ''}" 
                   onclick="changePage(${currentPage - 1})">
                    <i class="fas fa-chevron-left"></i>
                </a>
            `;

            // Pages
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            if (startPage > 1) {
                paginationHTML += `
                    <a href="#" class="page-btn" onclick="changePage(1)">1</a>
                    <span class="page-dots">...</span>
                `;
            }

            for (let i = startPage; i <= endPage; i++) {
                paginationHTML += `
                    <a href="#" class="page-btn ${currentPage === i ? 'active' : ''}" 
                       onclick="changePage(${i})">${i}</a>
                `;
            }

            if (endPage < totalPages) {
                paginationHTML += `
                    <span class="page-dots">...</span>
                    <a href="#" class="page-btn" onclick="changePage(${totalPages})">${totalPages}</a>
                `;
            }

            // Bouton suivant
            paginationHTML += `
                <a href="#" class="page-btn ${currentPage === totalPages ? 'disabled' : ''}" 
                   onclick="changePage(${currentPage + 1})">
                    <i class="fas fa-chevron-right"></i>
                </a>
            `;

            pagination.innerHTML = paginationHTML;
        }

        // Mettre à jour les statistiques
        function updateStats() {
            const totalVotes = nomineesData.reduce((sum, nominee) => sum + nominee.votes, 0);
            const votersCount = Math.floor(totalVotes / 3.24); // Simulation
            const daysLeft = Math.floor((new Date('2026-02-12') - new Date()) / (1000 * 60 * 60 * 24));

            // Trouver la catégorie la plus populaire
            const categoryTotals = {};
            nomineesData.forEach(nominee => {
                categoryTotals[nominee.categoryName] = (categoryTotals[nominee.categoryName] || 0) + nominee.votes;
            });
            const topCategory = Object.entries(categoryTotals).reduce((a, b) => a[1] > b[1] ? a : b)[0];

            document.getElementById('totalVotes').textContent = totalVotes.toLocaleString();
            document.getElementById('votersCount').textContent = votersCount.toLocaleString();
            document.getElementById('topCategory').textContent = topCategory;
            document.getElementById('daysLeft').textContent = Math.max(0, daysLeft);
        }

        // Recherche
        searchInput.addEventListener('input', function() {
            currentSearch = this.value.toLowerCase();
            currentPage = 1;
            renderNominees();
        });

        // Filtres par catégorie
        categoryBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                categoryBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentCategory = this.getAttribute('data-category');
                currentPage = 1;
                renderNominees();
            });
        });

        // Ouvrir le modal de vote
        window.openVoteModal = function(nomineeId) {
            currentNomineeId = nomineeId;
            const nominee = nomineesData.find(n => n.id === nomineeId);
            
            if (!nominee) return;

            // Mettre à jour le modal
            document.getElementById('modalNomineeImage').src = nominee.image;
            document.getElementById('modalNomineeName').textContent = nominee.name;
            document.getElementById('modalNomineeCategory').textContent = `Catégorie ${nominee.categoryName}`;
            document.getElementById('modalNomineeTitle').textContent = nominee.title;

            // Afficher le modal
            voteModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        // Confirmer le vote
        confirmVoteBtn.addEventListener('click', function() {
            if (!currentNomineeId) return;

            const nominee = nomineesData.find(n => n.id === currentNomineeId);
            if (nominee) {
                // Augmenter le nombre de votes
                nominee.votes++;
                
                // Ajouter aux votes de l'utilisateur
                votedNominees.push(currentNomineeId);
                localStorage.setItem('votedNominees', JSON.stringify(votedNominees));

                // Mettre à jour l'affichage
                const voteBtn = document.querySelector(`.vote-btn[data-id="${currentNomineeId}"]`);
                if (voteBtn) {
                    voteBtn.innerHTML = '<i class="fas fa-check"></i> Déjà voté';
                    voteBtn.classList.add('voted');
                    voteBtn.disabled = true;
                }

                // Mettre à jour les statistiques
                updateStats();

                // Afficher un message de confirmation
                alert(`Merci d'avoir voté pour ${nominee.name} !\nVotre vote a été enregistré avec succès.`);
            }

            // Fermer le modal
            voteModal.classList.remove('active');
            document.body.style.overflow = 'auto';
            currentNomineeId = null;
        });

        // Annuler le vote
        cancelVoteBtn.addEventListener('click', function() {
            voteModal.classList.remove('active');
            document.body.style.overflow = 'auto';
            currentNomineeId = null;
        });

        // Fermer le modal en cliquant à l'extérieur
        voteModal.addEventListener('click', function(e) {
            if (e.target === this) {
                voteModal.classList.remove('active');
                document.body.style.overflow = 'auto';
                currentNomineeId = null;
            }
        });

        // Changer de page
        window.changePage = function(page) {
            if (page < 1 || page > Math.ceil(filterNominees().length / nomineesPerPage)) return;
            currentPage = page;
            renderNominees();
            
            // Scroll vers le haut de la section
            document.querySelector('.nomines').scrollIntoView({ 
                behavior: 'smooth',
                block: 'start'
            });
        };

        // Voir les détails d'un nominé
        window.viewNominee = function(id) {
            const nominee = nomineesData.find(n => n.id === id);
            if (nominee) {
                alert(`${nominee.name}\n\nCatégorie: ${nominee.categoryName}\n\n${nominee.title}\n\n${nominee.description}\n\nTotal des votes: ${nominee.votes.toLocaleString()}`);
            }
            return false;
        };

        // Partager un nominé
        window.shareNominee = function(id) {
            const nominee = nomineesData.find(n => n.id === id);
            if (nominee && navigator.share) {
                navigator.share({
                    title: `Votez pour ${nominee.name} - La ROUR 2026`,
                    text: `Je viens de découvrir ${nominee.name} nominé(e) pour La ROUR 2026 ! Votez maintenant.`,
                    url: window.location.href
                });
            } else {
                // Fallback pour les navigateurs qui ne supportent pas l'API Web Share
                const url = `${window.location.origin}${window.location.pathname}?nominee=${id}`;
                prompt("Copiez ce lien pour partager :", url);
            }
            return false;
        };

        // Initialiser l'affichage
        renderNominees();

        // Animation au défilement
        const animateOnScroll = () => {
            const cards = document.querySelectorAll('.nominee-card');
            const windowHeight = window.innerHeight;
            
            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                if (cardTop < windowHeight * 0.9) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        };

        // Écouter le défilement
        window.addEventListener('scroll', animateOnScroll);
        // Initialiser une première fois
        animateOnScroll();
    });
</script>
@endsection