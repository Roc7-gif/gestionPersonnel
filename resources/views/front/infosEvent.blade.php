@extends('layout')

@section('style')
<style>
    /* Styles spécifiques à la page Infos Événement */
    .page-hero {
        background: linear-gradient(rgba(26, 26, 46, 0.9), rgba(233, 30, 99, 0.3)),
            url('https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
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

    /* Section Programme */
    .programme {
        padding: 80px 0;
        background-color: var(--light-gray);
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

    .tabs {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
        flex-wrap: wrap;
        gap: 10px;
    }

    .tab-btn {
        padding: 12px 30px;
        background: var(--white);
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        border-radius: 50px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        font-size: 1rem;
    }

    .tab-btn.active {
        background: var(--primary-color);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.2);
    }

    .tab-btn:hover:not(.active) {
        background: rgba(233, 30, 99, 0.1);
    }

    .tab-content {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .tab-content.active {
        display: block;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .day-schedule {
        background: var(--white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .time-slot {
        display: flex;
        padding: 25px 30px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: var(--transition);
    }

    .time-slot:hover {
        background: rgba(233, 30, 99, 0.02);
        transform: translateX(5px);
    }

    .time-slot:last-child {
        border-bottom: none;
    }

    .time {
        min-width: 120px;
        font-weight: 600;
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    .slot-info h4 {
        font-size: 1.2rem;
        margin-bottom: 8px;
        color: var(--dark-color);
    }

    .slot-info p {
        color: var(--medium-gray);
        margin-bottom: 5px;
        font-size: 0.95rem;
    }

    .speaker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: var(--primary-color);
        font-weight: 500;
        font-size: 0.9rem;
    }

    /* Section Lieu */
    .location {
        padding: 80px 0;
    }

    .location-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: center;
    }

    .location-info h3 {
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: var(--dark-color);
    }

    .location-details {
        list-style: none;
        margin-bottom: 30px;
    }

    .location-details li {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
        color: var(--medium-gray);
    }

    .location-details i {
        color: var(--primary-color);
        width: 20px;
        text-align: center;
    }

    .location-map {
        height: 400px;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
        position: relative;
    }

    .location-map::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(233, 30, 99, 0.1), rgba(156, 39, 176, 0.1));
        z-index: 1;
        pointer-events: none;
    }

    .map-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(45deg, #f5f5f7, #e0e0e7);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--medium-gray);
        font-size: 1.1rem;
        flex-direction: column;
        gap: 15px;
    }

    .map-placeholder i {
        font-size: 50px;
        color: var(--primary-color);
    }

    /* Section Prix et Billets */
    .pricing {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--dark-color), #2d2d44);
        color: var(--white);
    }

    .pricing-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    .pricing-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        overflow: hidden;
        transition: var(--transition);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .pricing-card:hover {
        transform: translateY(-10px);
        background: rgba(255, 255, 255, 0.15);
        border-color: var(--primary-color);
    }

    .pricing-card.popular {
        position: relative;
        transform: scale(1.05);
        border: 2px solid var(--primary-color);
    }

    .popular-badge {
        position: absolute;
        top: 20px;
        right: -10px;
        background: var(--primary-color);
        color: var(--white);
        padding: 8px 20px;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 5px;
        transform: rotate(15deg);
    }

    .pricing-header {
        padding: 40px 30px 30px;
        text-align: center;
        background: rgba(255, 255, 255, 0.05);
    }

    .pricing-header h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .price {
        font-size: 3rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 5px;
    }

    .price span {
        font-size: 1rem;
        opacity: 0.8;
    }

    .pricing-features {
        padding: 30px;
    }

    .pricing-features ul {
        list-style: none;
        margin-bottom: 30px;
    }

    .pricing-features li {
        padding: 10px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pricing-features li:last-child {
        border-bottom: none;
    }

    .pricing-features i {
        color: var(--primary-color);
    }

    .btn-buy {
        display: block;
        width: 100%;
        padding: 15px;
        background: var(--primary-color);
        color: var(--white);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        transition: var(--transition);
        text-align: center;
        text-decoration: none;
    }

    .btn-buy:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
    }

    /* Section FAQ */
    .faq {
        padding: 80px 0;
    }

    .faq-container {
        max-width: 800px;
        margin: 0 auto;
    }

    .faq-item {
        margin-bottom: 15px;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
    }

    .faq-question {
        padding: 20px 30px;
        background: var(--white);
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .faq-question:hover {
        background: rgba(233, 30, 99, 0.02);
    }

    .faq-question h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: var(--dark-color);
    }

    .faq-toggle {
        color: var(--primary-color);
        transition: transform 0.3s ease;
    }

    .faq-answer {
        padding: 0 30px;
        max-height: 0;
        overflow: hidden;
        transition: all 0.3s ease;
        background: var(--white);
    }

    .faq-answer.active {
        padding: 0 30px 30px;
        max-height: 500px;
    }

    .faq-answer p {
        color: var(--medium-gray);
        line-height: 1.7;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .location-container {
            grid-template-columns: 1fr;
            gap: 40px;
        }

        .pricing-card.popular {
            transform: none;
        }

        .page-hero h1 {
            font-size: 2.8rem;
        }
    }

    @media (max-width: 768px) {
        .page-hero {
            padding: 120px 0 60px;
        }

        .page-hero h1 {
            font-size: 2.2rem;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .tabs {
            flex-direction: column;
            align-items: center;
        }

        .tab-btn {
            width: 100%;
            max-width: 300px;
        }

        .time-slot {
            flex-direction: column;
            gap: 10px;
            padding: 20px;
        }

        .time {
            min-width: auto;
            font-size: 1rem;
        }

        .faq-question {
            padding: 15px 20px;
        }

        .faq-question h3 {
            font-size: 1rem;
        }

        .faq-answer,
        .faq-answer.active {
            padding-left: 20px;
            padding-right: 20px;
        }
    }

    @media (max-width: 480px) {
        .pricing-cards {
            grid-template-columns: 1fr;
        }

        .price {
            font-size: 2.5rem;
        }
    }
</style>
@endsection

@section('body')
<!-- Section Hero -->
<section class="page-hero" id="infos">
    <div class="container">
        <h1>Informations Événement</h1>
        <p>Tout ce que vous devez savoir sur La ROUR 2026. Dates, programme, lieu, billets et informations pratiques pour ne rien manquer de cet événement exceptionnel.</p>
    </div>
</section>

<!-- Section Programme -->
<section class="programme">
    <div class="container">
        <div class="section-title">
            <h2>Programme Détaillé</h2>
            <p>Découvrez le déroulement de ces trois jours exceptionnels</p>
        </div>

        <div class="tabs">
            <button class="tab-btn active" data-tab="jour1">Jour 1 - 12 Février</button>
            <button class="tab-btn" data-tab="jour2">Jour 2 - 13 Février</button>
            <button class="tab-btn" data-tab="jour3">Jour 3 - 14 Février</button>
        </div>

        <!-- Jour 1 -->
        <div class="tab-content active" id="jour1">
            <div class="day-schedule">
                <div class="time-slot">
                    <div class="time">16:00 - 17:00</div>
                    <div class="slot-info">
                        <h4>Accueil des invités</h4>
                        <p>Enregistrement et distribution des badges</p>
                        <span class="speaker"><i class="fas fa-user"></i> Équipe d'accueil</span>
                    </div>
                </div>
                <div class="time-slot">
                    <div class="time">17:00 - 18:30</div>
                    <div class="slot-info">
                        <h4>Vernissage des œuvres d'art</h4>
                        <p>Exposition des œuvres nominées - Catégorie Arts Visuels</p>
                        <span class="speaker"><i class="fas fa-user"></i> Curateur: Jean Koffi</span>
                    </div>
                </div>
                <div class="time-slot">
                    <div class="time">18:30 - 20:00</div>
                    <div class="slot-info">
                        <h4>Première cérémonie de remise des prix</h4>
                        <p>• Meilleure photographie • Meilleure sculpture • Meilleure peinture</p>
                        <span class="speaker"><i class="fas fa-user"></i> Président: Amina Diallo</span>
                    </div>
                </div>
                <div class="time-slot">
                    <div class="time">20:00 - 22:00</div>
                    <div class="slot-info">
                        <h4>Cocktail de bienvenue et networking</h4>
                        <p>Rencontre avec les artistes et les invités spéciaux</p>
                        <span class="speaker"><i class="fas fa-user"></i> DJ Sarah Music</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jour 2 -->
        <div class="tab-content" id="jour2">
            <div class="day-schedule">
                <div class="time-slot">
                    <div class="time">15:00 - 17:00</div>
                    <div class="slot-info">
                        <h4>Workshop créatif</h4>
                        <p>"L'art comme vecteur de changement social"</p>
                        <span class="speaker"><i class="fas fa-user"></i> Animé par: Dr. Léa Mensah</span>
                    </div>
                </div>
                <div class="time-slot">
                    <div class="time">17:00 - 19:00</div>
                    <div class="slot-info">
                        <h4>Projection cinématographique</h4>
                        <p>Films nominés - Court et long métrages</p>
                        <span class="speaker"><i class="fas fa-user"></i> Modérateur: Samuel Gnon</span>
                    </div>
                </div>
                <div class="time-slot">
                    <div class="time">19:00 - 21:30</div>
                    <div class="slot-info">
                        <h4>Deuxième cérémonie de remise des prix</h4>
                        <p>• Meilleur film • Meilleur acteur • Meilleure actrice • Meilleur réalisateur</p>
                        <span class="speaker"><i class="fas fa-user"></i> Président: Koffi Dan</span>
                    </div>
                </div>
                <div class="time-slot">
                    <div class="time">21:30 - 00:00</div>
                    <div class="slot-info">
                        <h4>Concert live</h4>
                        <p>Performances des artistes musicaux nominés</p>
                        <span class="speaker"><i class="fas fa-user"></i> Headliner: Star Mélodie</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jour 3 -->
        <div class="tab-content" id="jour3">
            <div class="day-schedule">
                <div class="time-slot">
                    <div class="time">16:00 - 18:00</div>
                    <div class="slot-info">
                        <h4>Table ronde des artistes</h4>
                        <p>"L'avenir de l'art en Afrique"</p>
                        <span class="speaker"><i class="fas fa-user"></i> Panélistes: 5 artistes primés</span>
                    </div>
                </div>
                <div class="time-slot">
                    <div class="time">18:00 - 20:30</div>
                    <div class="slot-info">
                        <h4>Grande cérémonie de clôture</h4>
                        <p>• Prix de la musique • Prix spéciaux • Prix Cœur d'Or</p>
                        <span class="speaker"><i class="fas fa-user"></i> Maître de cérémonie: Fatou N'Diaye</span>
                    </div>
                </div>
                <div class="time-slot">
                    <div class="time">20:30 - 22:00</div>
                    <div class="slot-info">
                        <h4>Dîner de gala</h4>
                        <p>Cuisine raffinée et échanges entre participants</p>
                        <span class="speaker"><i class="fas fa-user"></i> Chef étoilé: Pierre Agbodjin</span>
                    </div>
                </div>
                <div class="time-slot">
                    <div class="time">22:00 - 02:00</div>
                    <div class="slot-info">
                        <h4>Grande soirée de clôture</h4>
                        <p>Fête avec DJ international et surprises</p>
                        <span class="speaker"><i class="fas fa-user"></i> DJ International: Black Afro</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Lieu -->
<section class="location">
    <div class="container">
        <div class="section-title">
            <h2>Lieu de l'Événement</h2>
            <p>Palais des Congrès de Lokossa - Un cadre prestigieux pour un événement d'exception</p>
        </div>

        <div class="location-container">
            <div class="location-info">
                <h3>Palais des Congrès de Lokossa</h3>
                <p style="color: var(--medium-gray); margin-bottom: 25px;">Situé au cœur de la ville, le Palais des Congrès offre un cadre moderne et élégant pour accueillir La ROUR 2026. Avec ses équipements de pointe et ses espaces polyvalents, il garantit une expérience inoubliable à tous les participants.</p>

                <ul class="location-details">
                    <li><i class="fas fa-map-marker-alt"></i> <strong>Adresse:</strong> Avenue de la Culture, Lokossa, Bénin</li>
                    <li><i class="fas fa-car"></i> <strong>Parking:</strong> 500 places gratuites disponibles</li>
                    <li><i class="fas fa-wheelchair"></i> <strong>Accessibilité:</strong> Entièrement accessible aux personnes à mobilité réduite</li>
                    <li><i class="fas fa-wifi"></i> <strong>Connexion:</strong> WiFi haute vitesse gratuit</li>
                    <li><i class="fas fa-utensils"></i> <strong>Restauration:</strong> Plusieurs options sur place</li>
                </ul>

                <a href="https://maps.google.com/?q=Palais+des+Congrès+Lokossa+Bénin" class="btn-buy" style="max-width: 250px; text-align: center;" target="_blank">
                    <i class="fas fa-directions"></i> Voir l'itinéraire
                </a>
            </div>

            <div class="location-map">
                <div class="map-placeholder">
                    <i class="fas fa-map-marked-alt"></i>
                    <p>Carte interactive du lieu</p>
                    <small>Cliquez pour agrandir</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section Prix et Billets -->
<section class="pricing" id="acheter">
    <div class="container">
        <div class="section-title" style="color: var(--white);">
            <h2>Prix et Billets</h2>
            <p>Choisissez la formule qui correspond le mieux à vos attentes</p>
        </div>

        <div class="pricing-cards">
            <!-- Billet 1 Jour -->
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Billet 1 Jour</h3>
                    <div class="price">10.000 <span>FCFA</span></div>
                    <p>Accès pour une journée au choix</p>
                </div>
                <div class="pricing-features">
                    <ul>
                        <li><i class="fas fa-check"></i> Accès aux cérémonies du jour</li>
                        <li><i class="fas fa-check"></i> Exposition des œuvres</li>
                        <li><i class="fas fa-check"></i> Cocktail de networking</li>
                        <li><i class="fas fa-check"></i> Programme du jour</li>
                        <li><i class="fas fa-times"></i> Accès aux workshops</li>
                        <li><i class="fas fa-times"></i> Dîner de gala</li>
                    </ul>
                    <button class="btn-buy" onclick="acheterBillet('1jour')">
                        <i class="fas fa-shopping-cart"></i> Acheter maintenant
                    </button>
                </div>
            </div>

            <!-- Pass 3 Jours (Populaire) -->
            <div class="pricing-card popular">
                <div class="popular-badge">POPULAIRE</div>
                <div class="pricing-header">
                    <h3>Pass 3 Jours</h3>
                    <div class="price">25.000 <span>FCFA</span></div>
                    <p>Économisez 5.000 FCFA</p>
                </div>
                <div class="pricing-features">
                    <ul>
                        <li><i class="fas fa-check"></i> Accès complet 3 jours</li>
                        <li><i class="fas fa-check"></i> Toutes les cérémonies</li>
                        <li><i class="fas fa-check"></i> Workshops exclusifs</li>
                        <li><i class="fas fa-check"></i> Dîner de gala inclus</li>
                        <li><i class="fas fa-check"></i> Goodies exclusifs</li>
                        <li><i class="fas fa-check"></i> Rencontre avec les artistes</li>
                    </ul>
                    <button class="btn-buy" onclick="acheterBillet('3jours')">
                        <i class="fas fa-shopping-cart"></i> Acheter maintenant
                    </button>
                </div>
            </div>

            <!-- Billet VIP -->
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Billet VIP</h3>
                    <div class="price">50.000 <span>FCFA</span></div>
                    <p>Expérience premium</p>
                </div>
                <div class="pricing-features">
                    <ul>
                        <li><i class="fas fa-check"></i> Tous les avantages 3 jours</li>
                        <li><i class="fas fa-check"></i> Places réservées première ligne</li>
                        <li><i class="fas fa-check"></i> Accès lounge VIP</li>
                        <li><i class="fas fa-check"></i> Parking VIP</li>
                        <li><i class="fas fa-check"></i> Cadeau premium</li>
                        <li><i class="fas fa-check"></i> Photo avec les artistes</li>
                    </ul>
                    <button class="btn-buy" onclick="acheterBillet('vip')">
                        <i class="fas fa-shopping-cart"></i> Acheter maintenant
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Section FAQ -->
<section class="faq">
    <div class="container">
        <div class="section-title">
            <h2>Questions Fréquentes</h2>
            <p>Trouvez rapidement les réponses à vos questions</p>
        </div>

        <div class="faq-container">
            <!-- Question 1 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Comment puis-je acheter mes billets ?</h3>
                    <span class="faq-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Vous pouvez acheter vos billets directement en ligne via notre plateforme sécurisée, ou les acheter physiquement aux points de vente suivants :</p>
                    <ul style="margin-top: 10px; padding-left: 20px; color: var(--medium-gray);">
                        <li>Bureau de La ROUR à Lokossa</li>
                        <li>Points de vente partenaires dans les principales villes</li>
                        <li>Par téléphone au +229 01 40 46 50 38</li>
                    </ul>
                </div>
            </div>

            <!-- Question 2 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Y a-t-il un code vestimentaire ?</h3>
                    <span class="faq-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Pour les cérémonies de jour, une tenue chic décontractée est recommandée. Pour le dîner de gala du dernier jour, une tenue de soirée est requise (costume pour les hommes, robe de soirée pour les femmes).</p>
                </div>
            </div>

            <!-- Question 3 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Puis-je obtenir un remboursement ?</h3>
                    <span class="faq-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Les billets sont remboursables jusqu'à 30 jours avant l'événement, avec des frais de gestion de 10%. Après cette date, les billets ne sont ni remboursables ni échangeables, sauf en cas d'annulation de l'événement par les organisateurs.</p>
                </div>
            </div>

            <!-- Question 4 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>L'événement est-il accessible aux personnes handicapées ?</h3>
                    <span class="faq-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Oui, le Palais des Congrès est entièrement accessible aux personnes à mobilité réduite. Des places réservées, des toilettes adaptées et un personnel d'assistance sont disponibles. Veuillez nous contacter à l'avance pour toute nécessité particulière.</p>
                </div>
            </div>

            <!-- Question 5 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Y a-t-il des hébergements à proximité ?</h3>
                    <span class="faq-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Nous avons négocié des tarifs préférentiels avec plusieurs hôtels partenaires à Lokossa. Consultez notre page "Hébergement" ou contactez-nous pour obtenir la liste et les codes promotionnels.</p>
                </div>
            </div>

            <!-- Question 6 -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Puis-je prendre des photos pendant l'événement ?</h3>
                    <span class="faq-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Les photos sans flash sont autorisées pendant les expositions et certaines parties des cérémonies. Cependant, l'utilisation de matériel professionnel (trépieds, équipement d'éclairage) nécessite une autorisation préalable. Les cérémonies principales peuvent être filmées uniquement par l'équipe officielle.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion des onglets du programme
        const tabBtns = document.querySelectorAll('.tab-btn');
        const tabContents = document.querySelectorAll('.tab-content');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const tabId = this.getAttribute('data-tab');

                // Désactiver tous les onglets
                tabBtns.forEach(b => b.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));

                // Activer l'onglet cliqué
                this.classList.add('active');
                document.getElementById(tabId).classList.add('active');
            });
        });

        // FAQ Accordéon
        const faqQuestions = document.querySelectorAll('.faq-question');

        faqQuestions.forEach(question => {
            question.addEventListener('click', function() {
                const answer = this.nextElementSibling;
                const toggle = this.querySelector('.faq-toggle i');

                // Fermer toutes les autres réponses
                faqQuestions.forEach(q => {
                    if (q !== this) {
                        const otherAnswer = q.nextElementSibling;
                        const otherToggle = q.querySelector('.faq-toggle i');
                        otherAnswer.classList.remove('active');
                        otherToggle.classList.remove('fa-chevron-up');
                        otherToggle.classList.add('fa-chevron-down');
                    }
                });

                // Basculer l'état actuel
                answer.classList.toggle('active');

                if (answer.classList.contains('active')) {
                    toggle.classList.remove('fa-chevron-down');
                    toggle.classList.add('fa-chevron-up');
                } else {
                    toggle.classList.remove('fa-chevron-up');
                    toggle.classList.add('fa-chevron-down');
                }
            });
        });

        // Animation au défilement
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.pricing-card, .faq-item, .day-schedule');

            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;

                if (elementTop < windowHeight * 0.9) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };

        // Initialiser l'état des éléments animés
        const animatedElements = document.querySelectorAll('.pricing-card, .faq-item, .day-schedule');
        animatedElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        // Écouter le défilement
        window.addEventListener('scroll', animateOnScroll);
        // Initialiser une première fois
        animateOnScroll();

        // Fonction d'achat de billets
        window.acheterBillet = function(type) {
            let message = '';
            let prix = '';

            switch (type) {
                case '1jour':
                    message = 'Billet 1 Jour - 10.000 FCFA';
                    prix = '10000';
                    break;
                case '3jours':
                    message = 'Pass 3 Jours - 25.000 FCFA';
                    prix = '25000';
                    break;
                case 'vip':
                    message = 'Billet VIP - 50.000 FCFA';
                    prix = '50000';
                    break;
            }

            const modal = `
                <div style="background: white; padding: 20px; border-radius: 10px; max-width: 400px; width: 90%;">
                    <h3 style="margin-bottom: 15px; color: var(--primary-color);">Achat de billet</h3>
                    <p style="margin-bottom: 20px;">Vous allez acheter: <strong>${message}</strong></p>
                    
                    <div style="margin-bottom: 20px;">
                        <label style="display: block; margin-bottom: 5px; font-weight: 500;">Quantité:</label>
                        <input type="number" id="quantite" value="1" min="1" max="10" 
                               style="width: 100%; padding: 10px; border: 2px solid #e0e0e0; border-radius: 5px;">
                    </div>
                    
                    <div style="display: flex; gap: 10px; margin-top: 20px;">
                        <button onclick="confirmerAchat('${type}', ${prix})" 
                                style="flex: 1; padding: 12px; background: var(--primary-color); color: white; border: none; border-radius: 5px; font-weight: 600; cursor: pointer;">
                            Confirmer
                        </button>
                        <button onclick="fermerModal()" 
                                style="flex: 1; padding: 12px; background: #f5f5f7; color: #666; border: none; border-radius: 5px; font-weight: 600; cursor: pointer;">
                            Annuler
                        </button>
                    </div>
                </div>
            `;

            // Créer une modal simple
            const modalOverlay = document.createElement('div');
            modalOverlay.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0,0,0,0.5);
                display: flex;
                align-items: center;
                justify-content: center;
                z-index: 9999;
            `;
            modalOverlay.innerHTML = modal;
            document.body.appendChild(modalOverlay);

            // Stocker les fonctions globales
            window.confirmerAchat = function(type, prix) {
                const quantite = document.getElementById('quantite').value;
                const total = prix * quantite;
                alert(`Commande confirmée!\n\nType: ${message}\nQuantité: ${quantite}\nTotal: ${total.toLocaleString()} FCFA\n\nUn email de confirmation vous sera envoyé.`);
                fermerModal();
            };

            window.fermerModal = function() {
                document.body.removeChild(modalOverlay);
                delete window.confirmerAchat;
                delete window.fermerModal;
            };
        };

        // Gestion de la carte interactive
        const mapPlaceholder = document.querySelector('.map-placeholder');
        if (mapPlaceholder) {
            mapPlaceholder.addEventListener('click', function() {
                window.open('https://www.google.com/maps/place/Lokossa,+B%C3%A9nin/@6.615,-1.716,14z/data=!4m6!3m5!1s0x1023b7e06b8b1801:0x40f71e0de100e5e2!8m2!3d6.618991!4d1.716246!16s%2Fm%2F0j3kh4r?entry=ttu', '_blank');
            });

            mapPlaceholder.style.cursor = 'pointer';
            mapPlaceholder.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.02)';
                this.style.transition = 'transform 0.3s ease';
            });
            mapPlaceholder.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
            });
        }
    });
</script>
@endsection