@extends('layout')

@section('style')
<style>
    /* Styles spécifiques à la page Achat de tickets */
    .page-hero {
        background: linear-gradient(rgba(26, 26, 46, 0.9), rgba(233, 30, 99, 0.3)),
            url('https://images.unsplash.com/photo-1533174072545-7a4b6ad7a6c3?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
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

    /* Processus d'achat */
    .purchase-process {
        padding: 80px 0 40px;
    }

    .process-steps {
        display: flex;
        justify-content: center;
        margin-bottom: 60px;
        position: relative;
    }

    .process-steps::before {
        content: '';
        position: absolute;
        top: 25px;
        left: 50px;
        right: 50px;
        height: 3px;
        background: var(--light-gray);
        z-index: 1;
    }

    .step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        z-index: 2;
        flex: 1;
        max-width: 200px;
    }

    .step-number {
        width: 50px;
        height: 50px;
        background: var(--light-gray);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
        margin-bottom: 15px;
        transition: var(--transition);
        border: 3px solid var(--white);
        color: var(--medium-gray);
    }

    .step.active .step-number {
        background: var(--primary-color);
        color: var(--white);
        transform: scale(1.1);
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
    }

    .step.completed .step-number {
        background: var(--secondary-color);
        color: var(--white);
    }

    .step-label {
        font-weight: 600;
        color: var(--medium-gray);
        text-align: center;
        font-size: 0.95rem;
    }

    .step.active .step-label {
        color: var(--primary-color);
    }

    .step.completed .step-label {
        color: var(--secondary-color);
    }

    /* Section Formule */
    .ticket-formula {
        padding: 40px 0;
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

    .formula-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .formula-card {
        background: var(--white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
        border: 2px solid transparent;
    }

    .formula-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .formula-card.selected {
        border-color: var(--primary-color);
    }

    .formula-badge {
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

    .formula-header {
        padding: 30px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: var(--white);
        text-align: center;
    }

    .formula-header h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
    }

    .formula-price {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 5px;
    }

    .formula-price span {
        font-size: 1rem;
        opacity: 0.9;
    }

    .formula-savings {
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .formula-features {
        padding: 30px;
    }

    .formula-features ul {
        list-style: none;
        margin-bottom: 25px;
    }

    .formula-features li {
        padding: 10px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .formula-features li:last-child {
        border-bottom: none;
    }

    .formula-features i.fa-check {
        color: var(--primary-color);
    }

    .formula-features i.fa-times {
        color: var(--medium-gray);
    }

    .select-btn {
        width: 100%;
        padding: 15px;
        background: var(--white);
        border: 2px solid var(--primary-color);
        color: var(--primary-color);
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        text-align: center;
        font-size: 1rem;
    }

    .select-btn:hover {
        background: var(--primary-color);
        color: var(--white);
        transform: translateY(-2px);
    }

    .select-btn.selected {
        background: var(--primary-color);
        color: var(--white);
    }

    /* Section Quantité */
    .ticket-quantity {
        padding: 40px 0;
        background-color: var(--light-gray);
        display: none;
    }

    .quantity-container {
        max-width: 600px;
        margin: 0 auto;
        background: var(--white);
        border-radius: 15px;
        padding: 40px;
        box-shadow: var(--shadow);
    }

    .selected-formula-info {
        display: flex;
        align-items: center;
        gap: 20px;
        margin-bottom: 30px;
        padding-bottom: 30px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .selected-formula-info h4 {
        font-size: 1.3rem;
        color: var(--dark-color);
        margin-bottom: 5px;
    }

    .selected-formula-info p {
        color: var(--medium-gray);
    }

    .selected-price {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    .quantity-selector {
        margin-bottom: 30px;
    }

    .quantity-label {
        display: block;
        margin-bottom: 15px;
        font-weight: 600;
        color: var(--dark-color);
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .quantity-btn {
        width: 50px;
        height: 50px;
        background: var(--light-gray);
        border: none;
        border-radius: 50%;
        font-size: 1.2rem;
        font-weight: 700;
        color: var(--dark-color);
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .quantity-btn:hover {
        background: var(--primary-color);
        color: var(--white);
    }

    .quantity-input {
        width: 80px;
        height: 50px;
        border: 2px solid var(--light-gray);
        border-radius: 8px;
        text-align: center;
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark-color);
    }

    .quantity-input:focus {
        outline: none;
        border-color: var(--primary-color);
    }

    .total-price {
        text-align: center;
        margin-top: 30px;
        padding-top: 30px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .total-price h4 {
        font-size: 1.1rem;
        margin-bottom: 10px;
        color: var(--dark-color);
    }

    .total-amount {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
    }

    /* Section Informations */
    .buyer-info {
        padding: 40px 0;
        display: none;
    }

    .info-container {
        max-width: 600px;
        margin: 0 auto;
        background: var(--white);
        border-radius: 15px;
        padding: 40px;
        box-shadow: var(--shadow);
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--dark-color);
    }

    .form-input {
        width: 100%;
        padding: 14px 20px;
        border: 2px solid var(--light-gray);
        border-radius: 8px;
        font-size: 1rem;
        transition: var(--transition);
        background-color: var(--white);
    }

    .form-input:focus {
        outline: none;
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(233, 30, 99, 0.1);
    }

    .form-input.error {
        border-color: #f44336;
    }

    .form-error {
        color: #f44336;
        font-size: 0.85rem;
        margin-top: 5px;
        display: none;
    }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .info-summary {
        background: rgba(233, 30, 99, 0.05);
        border-radius: 10px;
        padding: 25px;
        margin-top: 30px;
        margin-bottom: 30px;
    }

    .summary-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .summary-item:last-child {
        border-bottom: none;
    }

    .summary-total {
        font-weight: 700;
        color: var(--primary-color);
        font-size: 1.1rem;
    }

    /* Section Paiement */
    .payment-section {
        padding: 40px 0;
        display: none;
    }

    .payment-container {
        max-width: 600px;
        margin: 0 auto;
        background: var(--white);
        border-radius: 15px;
        padding: 40px;
        box-shadow: var(--shadow);
    }

    .payment-methods {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 15px;
        margin-bottom: 30px;
    }

    .payment-method {
        padding: 20px;
        border: 2px solid var(--light-gray);
        border-radius: 10px;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
        background: var(--white);
    }

    .payment-method:hover {
        border-color: var(--primary-color);
        transform: translateY(-3px);
    }

    .payment-method.selected {
        border-color: var(--primary-color);
        background: rgba(233, 30, 99, 0.05);
    }

    .payment-icon {
        font-size: 30px;
        margin-bottom: 10px;
        color: var(--primary-color);
    }

    .payment-details {
        margin-top: 30px;
    }

    .card-input {
        position: relative;
        margin-bottom: 20px;
    }

    .card-input i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--medium-gray);
    }

    .card-input input {
        width: 100%;
        padding: 14px 20px 14px 45px;
        border: 2px solid var(--light-gray);
        border-radius: 8px;
        font-size: 1rem;
    }

    .card-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Navigation entre les étapes */
    .step-navigation {
        display: flex;
        justify-content: space-between;
        margin-top: 40px;
        padding-top: 40px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .nav-btn {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .nav-btn.prev {
        background: var(--light-gray);
        color: var(--dark-color);
    }

    .nav-btn.prev:hover {
        background: #e0e0e7;
    }

    .nav-btn.next {
        background: var(--primary-color);
        color: var(--white);
    }

    .nav-btn.next:hover {
        background: var(--primary-dark);
    }

    .nav-btn.next:disabled {
        background: var(--medium-gray);
        cursor: not-allowed;
    }

    /* Section Confirmation */
    .confirmation-section {
        padding: 80px 0;
        text-align: center;
        display: none;
    }

    .confirmation-container {
        max-width: 600px;
        margin: 0 auto;
        background: var(--white);
        border-radius: 15px;
        padding: 60px 40px;
        box-shadow: var(--shadow);
    }

    .confirmation-icon {
        font-size: 80px;
        color: var(--primary-color);
        margin-bottom: 30px;
    }

    .confirmation-container h2 {
        font-family: 'Playfair Display', serif;
        font-size: 2.5rem;
        margin-bottom: 20px;
        color: var(--dark-color);
    }

    .confirmation-container p {
        color: var(--medium-gray);
        margin-bottom: 30px;
        line-height: 1.6;
    }

    .ticket-details {
        background: rgba(233, 30, 99, 0.05);
        border-radius: 10px;
        padding: 25px;
        margin: 30px 0;
        text-align: left;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .page-hero h1 {
            font-size: 2.8rem;
        }

        .process-steps::before {
            left: 30px;
            right: 30px;
        }

        .step-label {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 768px) {
        .page-hero {
            padding: 120px 0 60px;
        }

        .page-hero h1 {
            font-size: 2.2rem;
        }

        .process-steps {
            flex-direction: column;
            gap: 30px;
            align-items: center;
        }

        .process-steps::before {
            display: none;
        }

        .step {
            flex-direction: row;
            gap: 15px;
            max-width: 100%;
            width: 100%;
        }

        .step-label {
            text-align: left;
        }

        .section-title h2 {
            font-size: 2rem;
        }

        .formula-cards {
            grid-template-columns: 1fr;
        }

        .form-row,
        .card-row {
            grid-template-columns: 1fr;
        }

        .quantity-container,
        .info-container,
        .payment-container,
        .confirmation-container {
            padding: 30px 20px;
        }

        .step-navigation {
            flex-direction: column;
            gap: 15px;
        }

        .nav-btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .page-hero h1 {
            font-size: 1.8rem;
        }

        .page-hero p {
            font-size: 1rem;
        }

        .formula-header {
            padding: 20px;
        }

        .formula-price {
            font-size: 2rem;
        }

        .selected-formula-info {
            flex-direction: column;
            text-align: center;
        }

        .confirmation-container h2 {
            font-size: 2rem;
        }
    }

    /* Animation */
    @keyframes fadeIn {
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
        animation: fadeIn 0.5s ease forwards;
    }
</style>
@endsection

@section('body')
<!-- Section Hero -->
<section class="page-hero" id="acheter">
    <div class="container">
        <h1>Acheter un Ticket</h1>
        <p>Assurez votre place pour l'événement culturel de l'année. Choisissez votre formule et rejoignez-nous pour trois jours exceptionnels.</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <div style="background: rgba(255, 255, 255, 0.2); padding: 8px 20px; border-radius: 50px; backdrop-filter: blur(10px);">
                <i class="fas fa-shield-alt"></i> Paiement 100% sécurisé
            </div>
            <div style="background: rgba(255, 255, 255, 0.2); padding: 8px 20px; border-radius: 50px; backdrop-filter: blur(10px);">
                <i class="fas fa-ticket-alt"></i> Billets instantanés
            </div>
            <div style="background: rgba(255, 255, 255, 0.2); padding: 8px 20px; border-radius: 50px; backdrop-filter: blur(10px);">
                <i class="fas fa-headset"></i> Support 24/7
            </div>
        </div>
    </div>
</section>

<!-- Processus d'achat -->
<section class="purchase-process">
    <div class="container">
        <div class="process-steps">
            <div class="step active" id="step1">
                <div class="step-number">1</div>
                <div class="step-label">Choisir la formule</div>
            </div>
            <div class="step" id="step2">
                <div class="step-number">2</div>
                <div class="step-label">Quantité</div>
            </div>
            <div class="step" id="step3">
                <div class="step-number">3</div>
                <div class="step-label">Informations</div>
            </div>
            <div class="step" id="step4">
                <div class="step-number">4</div>
                <div class="step-label">Paiement</div>
            </div>
        </div>
    </div>
</section>

<!-- Étape 1 : Choisir la formule -->
<section class="ticket-formula" id="formulaSection">
    <div class="container">
        <div class="section-title">
            <h2>Choisissez Votre Formule</h2>
            <p>Sélectionnez le ticket qui correspond le mieux à vos attentes</p>
        </div>

        <div class="formula-cards">
            <!-- Formule 1 Jour -->
            <div class="formula-card" data-formula="1jour">
                <div class="formula-badge">Populaire</div>
                <div class="formula-header">
                    <h3>Billet 1 Jour</h3>
                    <div class="formula-price">10.000 <span>FCFA</span></div>
                    <p class="formula-savings">Accès pour une journée au choix</p>
                </div>
                <div class="formula-features">
                    <ul>
                        <li><i class="fas fa-check"></i> Accès aux cérémonies du jour</li>
                        <li><i class="fas fa-check"></i> Exposition des œuvres</li>
                        <li><i class="fas fa-check"></i> Cocktail de networking</li>
                        <li><i class="fas fa-check"></i> Programme du jour</li>
                        <li><i class="fas fa-times"></i> Accès aux workshops</li>
                        <li><i class="fas fa-times"></i> Dîner de gala</li>
                        <li><i class="fas fa-times"></i> Goodies exclusifs</li>
                    </ul>
                    <button class="select-btn" onclick="selectFormula('1jour')">
                        <i class="fas fa-check"></i> Sélectionner
                    </button>
                </div>
            </div>

            <!-- Formule 3 Jours -->
            <div class="formula-card selected" data-formula="3jours">
                <div class="formula-badge">Meilleure valeur</div>
                <div class="formula-header">
                    <h3>Pass 3 Jours</h3>
                    <div class="formula-price">25.000 <span>FCFA</span></div>
                    <p class="formula-savings">Économisez 5.000 FCFA</p>
                </div>
                <div class="formula-features">
                    <ul>
                        <li><i class="fas fa-check"></i> Accès complet 3 jours</li>
                        <li><i class="fas fa-check"></i> Toutes les cérémonies</li>
                        <li><i class="fas fa-check"></i> Workshops exclusifs</li>
                        <li><i class="fas fa-check"></i> Dîner de gala inclus</li>
                        <li><i class="fas fa-check"></i> Goodies exclusifs</li>
                        <li><i class="fas fa-check"></i> Rencontre avec les artistes</li>
                        <li><i class="fas fa-check"></i> Parking réservé</li>
                    </ul>
                    <button class="select-btn selected" onclick="selectFormula('3jours')">
                        <i class="fas fa-check"></i> Sélectionné
                    </button>
                </div>
            </div>

            <!-- Formule VIP -->
            <div class="formula-card" data-formula="vip">
                <div class="formula-badge">Premium</div>
                <div class="formula-header">
                    <h3>Billet VIP</h3>
                    <div class="formula-price">50.000 <span>FCFA</span></div>
                    <p class="formula-savings">Expérience premium</p>
                </div>
                <div class="formula-features">
                    <ul>
                        <li><i class="fas fa-check"></i> Tous les avantages 3 jours</li>
                        <li><i class="fas fa-check"></i> Places réservées première ligne</li>
                        <li><i class="fas fa-check"></i> Accès lounge VIP</li>
                        <li><i class="fas fa-check"></i> Parking VIP</li>
                        <li><i class="fas fa-check"></i> Cadeau premium</li>
                        <li><i class="fas fa-check"></i> Photo avec les artistes</li>
                        <li><i class="fas fa-check"></i> Service concierge</li>
                    </ul>
                    <button class="select-btn" onclick="selectFormula('vip')">
                        <i class="fas fa-check"></i> Sélectionner
                    </button>
                </div>
            </div>
        </div>

        <div class="step-navigation">
            <div style="width: 100px;"></div> <!-- Espaceur -->
            <button class="nav-btn next" id="nextToQuantity" onclick="nextStep('quantity')">
                Suivant <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- Étape 2 : Quantité -->
<section class="ticket-quantity" id="quantitySection">
    <div class="container">
        <div class="quantity-container fade-in">
            <div class="selected-formula-info">
                <div>
                    <h4 id="selectedFormulaName">Pass 3 Jours</h4>
                    <p id="selectedFormulaDesc">Accès complet aux 3 jours d'événement</p>
                </div>
                <div class="selected-price" id="selectedFormulaPrice">25.000 FCFA</div>
            </div>

            <div class="quantity-selector">
                <label class="quantity-label">Nombre de tickets :</label>
                <div class="quantity-controls">
                    <button class="quantity-btn" onclick="updateQuantity(-1)">
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" id="quantityInput" class="quantity-input" value="1" min="1" max="10">
                    <button class="quantity-btn" onclick="updateQuantity(1)">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </div>

            <div class="total-price">
                <h4>Total à payer</h4>
                <div class="total-amount" id="totalAmount">25.000 FCFA</div>
            </div>

            <div class="step-navigation">
                <button class="nav-btn prev" onclick="prevStep('formula')">
                    <i class="fas fa-arrow-left"></i> Retour
                </button>
                <button class="nav-btn next" onclick="nextStep('info')">
                    Continuer <i class="fas fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Étape 3 : Informations -->
<section class="buyer-info" id="infoSection">
    <div class="container">
        <div class="info-container fade-in">
            <h3 style="margin-bottom: 30px; color: var(--dark-color);">Vos informations</h3>

            <form id="buyerForm">
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Prénom *</label>
                        <input type="text" class="form-input" id="firstName" required>
                        <div class="form-error" id="firstNameError">Veuillez entrer votre prénom</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Nom *</label>
                        <input type="text" class="form-input" id="lastName" required>
                        <div class="form-error" id="lastNameError">Veuillez entrer votre nom</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Email *</label>
                    <input type="email" class="form-input" id="email" required>
                    <div class="form-error" id="emailError">Veuillez entrer un email valide</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Téléphone *</label>
                    <input type="tel" class="form-input" id="phone" required>
                    <div class="form-error" id="phoneError">Veuillez entrer un numéro de téléphone valide</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Code promotionnel (optionnel)</label>
                    <input type="text" class="form-input" id="promoCode" placeholder="Ex: ROUR2026">
                    <small style="color: var(--medium-gray); font-size: 0.85rem;">Entrez votre code promotionnel si vous en avez un</small>
                </div>

                <div class="info-summary">
                    <h4 style="margin-bottom: 15px; color: var(--dark-color);">Récapitulatif de commande</h4>
                    <div class="summary-item">
                        <span id="summaryFormula">Pass 3 Jours x1</span>
                        <span id="summaryPrice">25.000 FCFA</span>
                    </div>
                    <div class="summary-item">
                        <span>Frais de service</span>
                        <span>0 FCFA</span>
                    </div>
                    <div class="summary-item summary-total">
                        <span>Total</span>
                        <span id="summaryTotal">25.000 FCFA</span>
                    </div>
                </div>

                <div class="form-group">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="checkbox" id="terms" required style="width: 18px; height: 18px;">
                        <span style="color: var(--medium-gray); font-size: 0.9rem;">
                            J'accepte les <a href="#" style="color: var(--primary-color);">conditions générales de vente</a> et la
                            <a href="#" style="color: var(--primary-color);">politique de confidentialité</a>
                        </span>
                    </label>
                    <div class="form-error" id="termsError">Vous devez accepter les conditions</div>
                </div>

                <div class="step-navigation">
                    <button class="nav-btn prev" type="button" onclick="prevStep('quantity')">
                        <i class="fas fa-arrow-left"></i> Retour
                    </button>
                    <button class="nav-btn next" type="button" onclick="validateForm()">
                        Payer <i class="fas fa-lock"></i>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Étape 4 : Paiement -->
<section class="payment-section" id="paymentSection">
    <div class="container">
        <div class="payment-container fade-in">
            <h3 style="margin-bottom: 30px; color: var(--dark-color);">Moyen de paiement</h3>

            <div class="payment-methods">
                <div class="payment-method selected" onclick="selectPayment('card')">
                    <div class="payment-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div>Carte bancaire</div>
                </div>
                <div class="payment-method" onclick="selectPayment('mobile')">
                    <div class="payment-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <div>Mobile Money</div>
                </div>
                <div class="payment-method" onclick="selectPayment('bank')">
                    <div class="payment-icon">
                        <i class="fas fa-university"></i>
                    </div>
                    <div>Virement bancaire</div>
                </div>
            </div>

            <!-- Carte bancaire -->
            <div class="payment-details" id="cardDetails">
                <div class="form-group">
                    <label class="form-label">Numéro de carte *</label>
                    <div class="card-input">
                        <i class="far fa-credit-card"></i>
                        <input type="text" id="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19">
                    </div>
                    <div class="form-error" id="cardNumberError">Numéro de carte invalide</div>
                </div>

                <div class="card-row">
                    <div class="form-group">
                        <label class="form-label">Date d'expiration *</label>
                        <input type="text" id="cardExpiry" placeholder="MM/AA" maxlength="5">
                        <div class="form-error" id="cardExpiryError">Date invalide</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">CVV *</label>
                        <input type="text" id="cardCvv" placeholder="123" maxlength="3">
                        <div class="form-error" id="cardCvvError">CVV invalide</div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Nom sur la carte *</label>
                    <input type="text" class="form-input" id="cardName" value="John Doe">
                </div>
            </div>

            <!-- Mobile Money -->
            <div class="payment-details" id="mobileDetails" style="display: none;">
                <div class="info-summary">
                    <p style="margin-bottom: 15px; color: var(--medium-gray);">
                        Pour payer par Mobile Money, veuillez effectuer le transfert vers le numéro suivant :
                    </p>
                    <div style="text-align: center; padding: 20px; background: var(--light-gray); border-radius: 10px; margin: 15px 0;">
                        <div style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color); margin-bottom: 10px;">
                            +229 01 40 46 50 38
                        </div>
                        <div style="color: var(--medium-gray);">
                            (Nexus Dynamics - La ROUR)
                        </div>
                    </div>
                    <p style="color: var(--medium-gray); font-size: 0.9rem;">
                        <i class="fas fa-info-circle"></i> Mentionnez votre numéro de commande dans le message du transfert.
                    </p>
                </div>
            </div>

            <!-- Virement bancaire -->
            <div class="payment-details" id="bankDetails" style="display: none;">
                <div class="info-summary">
                    <p style="margin-bottom: 15px; color: var(--medium-gray);">
                        Coordonnées bancaires pour le virement :
                    </p>
                    <div style="padding: 15px; background: var(--light-gray); border-radius: 10px; margin: 15px 0;">
                        <div class="summary-item">
                            <span>Banque :</span>
                            <span>Bank of Africa</span>
                        </div>
                        <div class="summary-item">
                            <span>RIB :</span>
                            <span>BJ061 01001 12345678901 78</span>
                        </div>
                        <div class="summary-item">
                            <span>Titulaire :</span>
                            <span>Nexus Dynamics SARL</span>
                        </div>
                        <div class="summary-item">
                            <span>Référence :</span>
                            <span>ROUR2026-[VOTRE EMAIL]</span>
                        </div>
                    </div>
                    <p style="color: var(--medium-gray); font-size: 0.9rem;">
                        <i class="fas fa-clock"></i> Les billets seront envoyés après confirmation du virement (24-48h).
                    </p>
                </div>
            </div>

            <div class="step-navigation">
                <button class="nav-btn prev" onclick="prevStep('info')">
                    <i class="fas fa-arrow-left"></i> Retour
                </button>
                <button class="nav-btn next" id="payButton" onclick="processPayment()">
                    <i class="fas fa-lock"></i> Payer maintenant
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Confirmation -->
<section class="confirmation-section" id="confirmationSection">
    <div class="container">
        <div class="confirmation-container fade-in">
            <div class="confirmation-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h2>Commande Confirmée !</h2>
            <p>
                Félicitations ! Votre commande a été traitée avec succès. Vous recevrez vos billets par email dans les minutes qui suivent.
                Conservez bien votre numéro de commande.
            </p>

            <div class="ticket-details">
                <div class="detail-item">
                    <span>Numéro de commande :</span>
                    <strong>ROUR-<span id="orderNumber">2026-001234</span></strong>
                </div>
                <div class="detail-item">
                    <span>Nom :</span>
                    <span id="confirmationName">John Doe</span>
                </div>
                <div class="detail-item">
                    <span>Email :</span>
                    <span id="confirmationEmail">john@example.com</span>
                </div>
                <div class="detail-item">
                    <span>Formule :</span>
                    <span id="confirmationFormula">Pass 3 Jours</span>
                </div>
                <div class="detail-item">
                    <span>Quantité :</span>
                    <span id="confirmationQuantity">1 billet</span>
                </div>
                <div class="detail-item">
                    <span>Total payé :</span>
                    <strong id="confirmationTotal">25.000 FCFA</strong>
                </div>
                <div class="detail-item">
                    <span>Date :</span>
                    <span id="confirmationDate">15 janvier 2026</span>
                </div>
            </div>

            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
                <a href="#" class="nav-btn next" onclick="window.print()" style="text-decoration: none;">
                    <i class="fas fa-print"></i> Imprimer
                </a>
                <a href="#" class="nav-btn prev" onclick="sendToEmail()" style="text-decoration: none;">
                    <i class="fas fa-envelope"></i> Envoyer par email
                </a>
                <a href="/" class="nav-btn next" style="text-decoration: none;">
                    <i class="fas fa-home"></i> Retour à l'accueil
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Variables globales
        let currentStep = 'formula';
        let selectedFormula = '3jours';
        let quantity = 1;
        let totalAmount = 25000;
        let selectedPayment = 'card';
        let orderData = {};

        // Prix des formules
        const formulaPrices = {
            '1jour': 10000,
            '3jours': 25000,
            'vip': 50000
        };

        const formulaNames = {
            '1jour': 'Billet 1 Jour',
            '3jours': 'Pass 3 Jours',
            'vip': 'Billet VIP'
        };

        // Sélectionner une formule
        window.selectFormula = function(formula) {
            selectedFormula = formula;

            // Mettre à jour l'affichage des cartes
            document.querySelectorAll('.formula-card').forEach(card => {
                card.classList.remove('selected');
                const btn = card.querySelector('.select-btn');
                btn.classList.remove('selected');
                btn.innerHTML = '<i class="fas fa-check"></i> Sélectionner';
            });

            const selectedCard = document.querySelector(`[data-formula="${formula}"]`);
            selectedCard.classList.add('selected');
            const selectedBtn = selectedCard.querySelector('.select-btn');
            selectedBtn.classList.add('selected');
            selectedBtn.innerHTML = '<i class="fas fa-check"></i> Sélectionné';

            // Mettre à jour les informations de la formule
            document.getElementById('selectedFormulaName').textContent = formulaNames[formula];
            document.getElementById('selectedFormulaPrice').textContent = `${formulaPrices[formula].toLocaleString()} FCFA`;

            // Mettre à jour le total
            updateTotal();
        };

        // Mettre à jour la quantité
        window.updateQuantity = function(change) {
            const input = document.getElementById('quantityInput');
            let newQuantity = parseInt(input.value) + change;

            if (newQuantity < 1) newQuantity = 1;
            if (newQuantity > 10) newQuantity = 10;

            input.value = newQuantity;
            quantity = newQuantity;
            updateTotal();
        };

        // Mettre à jour le total
        function updateTotal() {
            totalAmount = formulaPrices[selectedFormula] * quantity;

            // Mettre à jour l'affichage
            document.getElementById('totalAmount').textContent = `${totalAmount.toLocaleString()} FCFA`;
            document.getElementById('summaryFormula').textContent = `${formulaNames[selectedFormula]} x${quantity}`;
            document.getElementById('summaryPrice').textContent = `${totalAmount.toLocaleString()} FCFA`;
            document.getElementById('summaryTotal').textContent = `${totalAmount.toLocaleString()} FCFA`;
        }

        // Gestion des étapes
        window.nextStep = function(step) {
            // Valider l'étape actuelle
            if (!validateCurrentStep()) return;

            // Cacher l'étape actuelle
            document.getElementById(`${currentStep}Section`).style.display = 'none';

            // Mettre à jour les étapes
            document.getElementById(`step${getStepNumber(currentStep)}`).classList.remove('active');
            document.getElementById(`step${getStepNumber(currentStep)}`).classList.add('completed');

            // Mettre à jour l'étape actuelle
            currentStep = step;

            // Afficher la nouvelle étape
            document.getElementById(`${step}Section`).style.display = 'block';
            document.getElementById(`step${getStepNumber(step)}`).classList.add('active');

            // Scroll vers le haut
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };

        window.prevStep = function(step) {
            // Cacher l'étape actuelle
            document.getElementById(`${currentStep}Section`).style.display = 'none';

            // Mettre à jour les étapes
            document.getElementById(`step${getStepNumber(currentStep)}`).classList.remove('active');

            // Mettre à jour l'étape actuelle
            currentStep = step;

            // Afficher la nouvelle étape
            document.getElementById(`${step}Section`).style.display = 'block';
            document.getElementById(`step${getStepNumber(step)}`).classList.add('active');

            // Scroll vers le haut
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };

        function getStepNumber(step) {
            const steps = {
                'formula': 1,
                'quantity': 2,
                'info': 3,
                'payment': 4
            };
            return steps[step];
        }

        // Valider l'étape actuelle
        function validateCurrentStep() {
            switch (currentStep) {
                case 'formula':
                    return selectedFormula !== null;
                case 'quantity':
                    return quantity > 0;
                case 'info':
                    return validateForm();
                case 'payment':
                    return validatePayment();
            }
            return true;
        }

        // Valider le formulaire
        window.validateForm = function() {
            let isValid = true;

            // Réinitialiser les erreurs
            document.querySelectorAll('.form-error').forEach(error => {
                error.style.display = 'none';
            });
            document.querySelectorAll('.form-input').forEach(input => {
                input.classList.remove('error');
            });

            // Valider le prénom
            const firstName = document.getElementById('firstName').value.trim();
            if (!firstName) {
                document.getElementById('firstNameError').style.display = 'block';
                document.getElementById('firstName').classList.add('error');
                isValid = false;
            }

            // Valider le nom
            const lastName = document.getElementById('lastName').value.trim();
            if (!lastName) {
                document.getElementById('lastNameError').style.display = 'block';
                document.getElementById('lastName').classList.add('error');
                isValid = false;
            }

            // Valider l'email
            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email || !emailRegex.test(email)) {
                document.getElementById('emailError').style.display = 'block';
                document.getElementById('email').classList.add('error');
                isValid = false;
            }

            // Valider le téléphone
            const phone = document.getElementById('phone').value.trim();
            const phoneRegex = /^[+]?[\d\s-]{8,}$/;
            if (!phone || !phoneRegex.test(phone)) {
                document.getElementById('phoneError').style.display = 'block';
                document.getElementById('phone').classList.add('error');
                isValid = false;
            }

            // Valider les conditions
            const terms = document.getElementById('terms').checked;
            if (!terms) {
                document.getElementById('termsError').style.display = 'block';
                isValid = false;
            }

            if (isValid) {
                // Sauvegarder les données
                orderData = {
                    firstName,
                    lastName,
                    email,
                    phone,
                    promoCode: document.getElementById('promoCode').value.trim(),
                    formula: selectedFormula,
                    formulaName: formulaNames[selectedFormula],
                    quantity,
                    totalAmount,
                    date: new Date().toLocaleDateString('fr-FR', {
                        year: 'numeric',
                        month: 'long',
                        day: 'numeric'
                    })
                };

                // Générer un numéro de commande
                orderData.orderNumber = `ROUR-2026-${Math.floor(100000 + Math.random() * 900000)}`;

                nextStep('payment');
            }

            return isValid;
        };

        // Sélectionner le moyen de paiement
        window.selectPayment = function(method) {
            selectedPayment = method;

            // Mettre à jour l'affichage
            document.querySelectorAll('.payment-method').forEach(pm => {
                pm.classList.remove('selected');
            });
            document.querySelector(`.payment-method[onclick="selectPayment('${method}')"]`).classList.add('selected');

            // Afficher les détails correspondants
            document.getElementById('cardDetails').style.display = 'none';
            document.getElementById('mobileDetails').style.display = 'none';
            document.getElementById('bankDetails').style.display = 'none';
            document.getElementById(`${method}Details`).style.display = 'block';
        };

        // Valider le paiement
        function validatePayment() {
            if (selectedPayment === 'card') {
                // Valider la carte
                const cardNumber = document.getElementById('cardNumber').value.replace(/\s/g, '');
                const cardExpiry = document.getElementById('cardExpiry').value;
                const cardCvv = document.getElementById('cardCvv').value;

                let isValid = true;

                // Valider le numéro de carte (simplifié)
                if (!cardNumber || cardNumber.length !== 16) {
                    document.getElementById('cardNumberError').style.display = 'block';
                    isValid = false;
                }

                // Valider la date d'expiration
                const expiryRegex = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/;
                if (!cardExpiry || !expiryRegex.test(cardExpiry)) {
                    document.getElementById('cardExpiryError').style.display = 'block';
                    isValid = false;
                }

                // Valider le CVV
                if (!cardCvv || cardCvv.length !== 3) {
                    document.getElementById('cardCvvError').style.display = 'block';
                    isValid = false;
                }

                return isValid;
            }

            return true; // Pour mobile money et virement, pas de validation supplémentaire
        }

        // Traiter le paiement
        window.processPayment = function() {
            if (!validatePayment()) return;

            // Simuler le traitement du paiement
            const payButton = document.getElementById('payButton');
            const originalText = payButton.innerHTML;

            payButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Traitement...';
            payButton.disabled = true;

            setTimeout(() => {
                // Mettre à jour la confirmation
                document.getElementById('orderNumber').textContent = orderData.orderNumber;
                document.getElementById('confirmationName').textContent = `${orderData.firstName} ${orderData.lastName}`;
                document.getElementById('confirmationEmail').textContent = orderData.email;
                document.getElementById('confirmationFormula').textContent = orderData.formulaName;
                document.getElementById('confirmationQuantity').textContent = `${orderData.quantity} billet${orderData.quantity > 1 ? 's' : ''}`;
                document.getElementById('confirmationTotal').textContent = `${orderData.totalAmount.toLocaleString()} FCFA`;
                document.getElementById('confirmationDate').textContent = orderData.date;

                // Passer à la confirmation
                document.getElementById('paymentSection').style.display = 'none';
                document.getElementById('confirmationSection').style.display = 'block';

                // Mettre à jour les étapes
                document.getElementById('step4').classList.remove('active');
                document.getElementById('step4').classList.add('completed');

                // Réinitialiser le bouton
                payButton.innerHTML = originalText;
                payButton.disabled = false;

                // Scroll vers le haut
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

                // Simuler l'envoi de l'email
                setTimeout(() => {
                    console.log('Email envoyé à :', orderData.email);
                }, 1000);
            }, 2000);
        };

        // Envoyer par email
        window.sendToEmail = function() {
            alert(`Un email a été envoyé à ${orderData.email} avec votre billet.`);
        };

        // Formatage automatique des champs
        document.getElementById('cardNumber')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\s/g, '');
            if (value.length > 16) value = value.substring(0, 16);
            e.target.value = value.replace(/(.{4})/g, '$1 ').trim();
        });

        document.getElementById('cardExpiry')?.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length >= 2) {
                e.target.value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
        });

        document.getElementById('cardCvv')?.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '').substring(0, 3);
        });

        document.getElementById('phone')?.addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });

        // Mettre à jour la quantité quand l'input change
        document.getElementById('quantityInput')?.addEventListener('change', function(e) {
            let newQuantity = parseInt(e.target.value);
            if (isNaN(newQuantity) || newQuantity < 1) newQuantity = 1;
            if (newQuantity > 10) newQuantity = 10;
            e.target.value = newQuantity;
            quantity = newQuantity;
            updateTotal();
        });

        // Initialiser
        updateTotal();
        selectPayment('card');
    });
</script>
@endsection