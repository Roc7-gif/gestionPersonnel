@extends('layout')

@section('style')
<style>
    /* Styles spécifiques à la page Voter */
    .page-hero {
        background: linear-gradient(rgba(26, 26, 46, 0.9), rgba(233, 30, 99, 0.3)),
            url('https://images.unsplash.com/photo-1551029506-0807df4e2031?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80');
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

    /* Section Comment Voter */
    .how-to-vote {
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

    .steps-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    .step-card {
        background: var(--white);
        border-radius: 15px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
    }

    .step-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .step-number {
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 40px;
        height: 40px;
        background: var(--primary-color);
        color: var(--white);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.2rem;
    }

    .step-icon {
        font-size: 50px;
        color: var(--primary-color);
        margin-bottom: 20px;
    }

    .step-card h3 {
        font-size: 1.3rem;
        margin-bottom: 15px;
        color: var(--dark-color);
    }

    .step-card p {
        color: var(--medium-gray);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Section Catégories */
    .categories-vote {
        padding: 80px 0;
    }

    .categories-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: center;
        margin-bottom: 40px;
    }

    .category-tab {
        padding: 12px 25px;
        background: var(--white);
        border: 2px solid var(--light-gray);
        color: var(--dark-color);
        border-radius: 50px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        font-size: 0.95rem;
        white-space: nowrap;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .category-tab.active {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.2);
    }

    .category-tab:hover:not(.active) {
        border-color: var(--primary-color);
        color: var(--primary-color);
        transform: translateY(-2px);
    }

    .category-tab i {
        font-size: 0.9rem;
    }

    .category-content {
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .category-content.active {
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

    .nominees-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    .nominee-item {
        background: var(--white);
        border-radius: 15px;
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: var(--transition);
        position: relative;
    }

    .nominee-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .nominee-header {
        padding: 25px 25px 0;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .nominee-avatar {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid var(--primary-color);
    }

    .nominee-info h4 {
        font-size: 1.2rem;
        margin-bottom: 5px;
        color: var(--dark-color);
    }

    .nominee-info p {
        color: var(--medium-gray);
        font-size: 0.9rem;
    }

    .nominee-body {
        padding: 20px 25px;
    }

    .nominee-description {
        color: var(--medium-gray);
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 20px;
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
        font-size: 1rem;
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
        cursor: default;
    }

    .vote-btn.voted:hover {
        background: var(--secondary-color);
        transform: none;
    }

    .vote-btn:disabled {
        background: var(--medium-gray);
        cursor: not-allowed;
    }

    .vote-btn:disabled:hover {
        transform: none;
    }

    /* Section Règles */
    .voting-rules {
        padding: 80px 0;
        background: linear-gradient(135deg, var(--dark-color), #2d2d44);
        color: var(--white);
    }

    .rules-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
    }

    .rule-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 30px;
        transition: var(--transition);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .rule-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.15);
        border-color: var(--primary-color);
    }

    .rule-icon {
        font-size: 40px;
        margin-bottom: 20px;
        color: var(--primary-color);
    }

    .rule-card h3 {
        font-size: 1.3rem;
        margin-bottom: 15px;
    }

    .rule-card p {
        opacity: 0.9;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Section Mes Votes */
    .my-votes {
        padding: 80px 0;
        background-color: var(--light-gray);
    }

    .votes-summary {
        max-width: 800px;
        margin: 0 auto;
        background: var(--white);
        border-radius: 15px;
        padding: 40px;
        box-shadow: var(--shadow);
    }

    .votes-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .votes-header h3 {
        font-size: 1.5rem;
        color: var(--dark-color);
    }

    .reset-btn {
        padding: 10px 20px;
        background: var(--light-gray);
        color: var(--dark-color);
        border: none;
        border-radius: 5px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .reset-btn:hover {
        background: #e0e0e7;
    }

    .votes-list {
        max-height: 400px;
        overflow-y: auto;
        margin-bottom: 30px;
    }

    .vote-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: var(--transition);
    }

    .vote-item:hover {
        background: rgba(233, 30, 99, 0.02);
    }

    .vote-item:last-child {
        border-bottom: none;
    }

    .vote-nominee-info {
        display: flex;
        align-items: center;
        gap: 15px;
        flex: 1;
    }

    .vote-nominee-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
    }

    .vote-nominee-details h4 {
        font-size: 1rem;
        margin-bottom: 5px;
        color: var(--dark-color);
    }

    .vote-nominee-details p {
        font-size: 0.85rem;
        color: var(--medium-gray);
    }

    .vote-category {
        background: rgba(233, 30, 99, 0.1);
        color: var(--primary-color);
        padding: 5px 15px;
        border-radius: 5px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-right: 20px;
    }

    .remove-vote {
        background: none;
        border: none;
        color: #f44336;
        cursor: pointer;
        font-size: 1.2rem;
        transition: var(--transition);
        padding: 5px;
        border-radius: 5px;
    }

    .remove-vote:hover {
        background: rgba(244, 67, 54, 0.1);
    }

    .no-votes {
        text-align: center;
        padding: 40px;
        color: var(--medium-gray);
    }

    .no-votes i {
        font-size: 50px;
        margin-bottom: 20px;
        color: var(--light-gray);
    }

    .submit-votes {
        text-align: center;
        padding-top: 30px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .submit-btn {
        padding: 15px 40px;
        background: var(--primary-color);
        color: var(--white);
        border: none;
        border-radius: 50px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .submit-btn:hover {
        background: var(--primary-dark);
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(233, 30, 99, 0.3);
    }

    .submit-btn:disabled {
        background: var(--medium-gray);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    /* Modal de Confirmation */
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

    .modal-content {
        background: var(--white);
        border-radius: 15px;
        max-width: 500px;
        width: 100%;
        overflow: hidden;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            transform: translateY(30px);
            opacity: 0;
        }

        to {
            transform: translateY(0);
            opacity: 1;
        }
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

    .modal-nominee-info {
        text-align: left;
    }

    .modal-nominee-info h4 {
        font-size: 1.3rem;
        margin-bottom: 5px;
        color: var(--dark-color);
    }

    .modal-nominee-info p {
        color: var(--medium-gray);
        font-size: 0.95rem;
    }

    .vote-warning {
        background: rgba(255, 193, 7, 0.1);
        color: #ff9800;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 25px;
        text-align: left;
    }

    .vote-warning h4 {
        font-size: 1rem;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .vote-warning ul {
        text-align: left;
        padding-left: 20px;
        font-size: 0.9rem;
        line-height: 1.5;
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

        .rules-container {
            grid-template-columns: 1fr;
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

        .categories-tabs {
            overflow-x: auto;
            padding-bottom: 10px;
            -webkit-overflow-scrolling: touch;
            justify-content: flex-start;
        }

        .nominees-grid {
            grid-template-columns: 1fr;
        }

        .nominee-header {
            flex-direction: column;
            text-align: center;
        }

        .votes-header {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .vote-item {
            flex-direction: column;
            gap: 15px;
            text-align: center;
        }

        .vote-nominee-info {
            flex-direction: column;
        }

        .vote-category {
            margin-right: 0;
            margin-bottom: 10px;
        }

        .votes-summary {
            padding: 30px 20px;
        }

        .modal-content {
            margin: 20px;
        }

        .modal-actions {
            flex-direction: column;
        }
    }

    @media (max-width: 480px) {
        .page-hero h1 {
            font-size: 1.8rem;
        }

        .page-hero p {
            font-size: 1rem;
        }

        .step-card {
            padding: 30px 20px;
        }

        .modal-nominee {
            flex-direction: column;
            text-align: center;
        }

        .modal-nominee-info {
            text-align: center;
        }
    }

    /* Animation */
    @keyframes pulse {
        0% {
            transform: scale(1);
        }

        50% {
            transform: scale(1.05);
        }

        100% {
            transform: scale(1);
        }
    }

    .pulse {
        animation: pulse 0.5s ease;
    }
</style>
@endsection

@section('body')
<!-- Section Hero -->
<section class="page-hero" id="voter">
    <div class="container">
        <h1>Voter Maintenant</h1>
        <p>Votre vote compte ! Participez à la sélection des meilleurs artistes de l'année 2026. Chaque vote est précieux pour récompenser le talent et la créativité.</p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-top: 30px;">
            <div style="background: rgba(255, 255, 255, 0.2); padding: 8px 20px; border-radius: 50px; backdrop-filter: blur(10px);">
                <i class="fas fa-clock"></i> Clôture des votes : 10 Février 2026
            </div>
            <div style="background: rgba(255, 255, 255, 0.2); padding: 8px 20px; border-radius: 50px; backdrop-filter: blur(10px);">
                <i class="fas fa-user-check"></i> 1 vote par catégorie
            </div>
        </div>
    </div>
</section>

<!-- Section Comment Voter -->
<section class="how-to-vote">
    <div class="container">
        <div class="section-title">
            <h2>Comment Voter ?</h2>
            <p>Le processus de vote est simple, rapide et transparent. Suivez ces étapes :</p>
        </div>

        <div class="steps-container">
            <div class="step-card fade-in">
                <div class="step-number">1</div>
                <div class="step-icon">
                    <i class="fas fa-search"></i>
                </div>
                <h3>Explorez les Catégories</h3>
                <p>Parcourez les différentes catégories et découvrez les talents nominés. Lisez leurs biographies et écoutez leurs œuvres.</p>
            </div>

            <div class="step-card fade-in">
                <div class="step-number">2</div>
                <div class="step-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Sélectionnez Vos Favoris</h3>
                <p>Cliquez sur "Voter" pour chaque artiste que vous souhaitez soutenir. Vous pouvez voter une fois par catégorie.</p>
            </div>

            <div class="step-card fade-in">
                <div class="step-number">3</div>
                <div class="step-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>Confirmez Vos Votes</h3>
                <p>Revoyez vos sélections dans "Mes Votes" et soumettez définitivement vos choix. Vous pouvez modifier avant soumission.</p>
            </div>

            <div class="step-card fade-in">
                <div class="step-number">4</div>
                <div class="step-icon">
                    <i class="fas fa-trophy"></i>
                </div>
                <h3>Suivez les Résultats</h3>
                <p>Les résultats seront annoncés lors de la cérémonie de remise des prix le 14 février 2026.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Catégories -->
<section class="categories-vote">
    <div class="container">
        <div class="section-title">
            <h2>Votez par Catégorie</h2>
            <p>Sélectionnez une catégorie pour découvrir les nominés et voter</p>
        </div>

        <div class="categories-tabs" id="categoriesTabs">
            <!-- Les onglets seront générés dynamiquement -->
        </div>

        <div id="categoriesContent">
            <!-- Le contenu des catégories sera généré dynamiquement -->
        </div>
    </div>
</section>

<!-- Section Règles -->
<section class="voting-rules">
    <div class="container">
        <div class="section-title" style="color: var(--white);">
            <h2>Règles de Vote</h2>
            <p>Pour garantir l'équité et la transparence du processus</p>
        </div>

        <div class="rules-container">
            <div class="rule-card">
                <div class="rule-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <h3>Un Vote par Catégorie</h3>
                <p>Chaque votant peut voter une seule fois par catégorie. Cette limite assure l'équité entre tous les nominés.</p>
            </div>

            <div class="rule-card">
                <div class="rule-icon">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3>Dates Limites</h3>
                <p>Les votes sont ouverts jusqu'au 10 février 2026 à minuit. Aucun vote ne sera accepté après cette date.</p>
            </div>

            <div class="rule-card">
                <div class="rule-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3>Transparence Totale</h3>
                <p>Le système de vote est vérifié et audité. Les résultats seront certifiés par un huissier de justice.</p>
            </div>

            <div class="rule-card">
                <div class="rule-icon">
                    <i class="fas fa-ban"></i>
                </div>
                <h3>Anti-Fraude</h3>
                <p>Toute tentative de fraude ou de manipulation des votes entraînera la disqualification immédiate.</p>
            </div>

            <div class="rule-card">
                <div class="rule-icon">
                    <i class="fas fa-undo-alt"></i>
                </div>
                <h3>Modifications</h3>
                <p>Vous pouvez modifier vos votes jusqu'à la soumission finale. Après soumission, les votes sont définitifs.</p>
            </div>

            <div class="rule-card">
                <div class="rule-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3>Vérification</h3>
                <p>Tous les votes sont soumis à vérification. Des votes suspects pourront être invalidés.</p>
            </div>
        </div>
    </div>
</section>

<!-- Section Mes Votes -->
<section class="my-votes">
    <div class="container">
        <div class="votes-summary">
            <div class="votes-header">
                <h3>Mes Votes <span id="votesCount">(0 votes)</span></h3>
                <button class="reset-btn" id="resetVotes">
                    <i class="fas fa-redo"></i> Tout effacer
                </button>
            </div>

            <div class="votes-list" id="votesList">
                <div class="no-votes" id="noVotesMessage">
                    <i class="fas fa-vote-yea"></i>
                    <h4>Aucun vote pour l'instant</h4>
                    <p>Commencez à voter en sélectionnant vos artistes préférés dans les catégories ci-dessus.</p>
                </div>
            </div>

            <div class="submit-votes">
                <button class="submit-btn" id="submitVotes" disabled>
                    <i class="fas fa-paper-plane"></i> Soumettre mes votes
                </button>
                <p style="color: var(--medium-gray); margin-top: 15px; font-size: 0.9rem;">
                    <i class="fas fa-info-circle"></i> Vous avez voté dans <span id="votedCategories">0</span> catégories sur 6
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Modal de Confirmation -->
<div class="vote-modal" id="voteModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Confirmer votre vote</h3>
            <p>Votre soutien est précieux pour nos artistes</p>
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

            <div class="vote-warning">
                <h4><i class="fas fa-exclamation-triangle"></i> Attention :</h4>
                <ul>
                    <li>Vous ne pouvez voter qu'une seule fois par catégorie</li>
                    <li>Ce vote remplacera votre précédent choix dans cette catégorie</li>
                    <li>Vous pouvez modifier votre choix jusqu'à la soumission finale</li>
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
    document.addEventListener('DOMContentLoaded', function() {
        // Données des catégories et nominés
        const categoriesData = [{
                id: 'musique',
                name: 'Musique',
                icon: 'fa-music',
                nominees: [{
                        id: 1,
                        name: "Amina Diallo",
                        title: "Chanteuse - Album 'Écho du Cœur'",
                        votes: 1245,
                        image: "https://randomuser.me/api/portraits/women/44.jpg",
                        description: "Artiste complète, auteur-compositeur-interprète, révélation de l'année 2025."
                    },
                    {
                        id: 2,
                        name: "Dj Afro",
                        title: "DJ/Producteur - Single 'Afro Fusion'",
                        votes: 2103,
                        image: "https://randomuser.me/api/portraits/men/75.jpg",
                        description: "Pionnier de l'afro-house au Bénin, 5 nominations aux African Music Awards."
                    },
                    {
                        id: 3,
                        name: "Étoile Mélodie",
                        title: "Chanteuse - Hit 'African Dream'",
                        votes: 1789,
                        image: "https://randomuser.me/api/portraits/women/33.jpg",
                        description: "Voice exceptionnelle, ambassadrice de la musique béninoise à l'international."
                    },
                    {
                        id: 4,
                        name: "Koffi Dan",
                        title: "Musicien - Album instrumental 'Harmonie'",
                        votes: 1107,
                        image: "https://randomuser.me/api/portraits/men/28.jpg",
                        description: "Virtuose du kora et compositeur talentueux, fusion moderne et traditionnelle."
                    }
                ]
            },
            {
                id: 'cinema',
                name: 'Cinéma & Théâtre',
                icon: 'fa-film',
                nominees: [{
                        id: 5,
                        name: "Jean Koffi",
                        title: "Réalisateur - Film 'Les Ombres de la Ville'",
                        votes: 892,
                        image: "https://randomuser.me/api/portraits/men/32.jpg",
                        description: "Visionnaire du cinéma africain contemporain, primé au FESPACO 2025."
                    },
                    {
                        id: 6,
                        name: "Fatou N'Diaye",
                        title: "Actrice - Rôle dans 'L'Héritage'",
                        votes: 934,
                        image: "https://randomuser.me/api/portraits/women/26.jpg",
                        description: "Performance remarquable dans un rôle dramatique complexe."
                    },
                    {
                        id: 7,
                        name: "Pierre Agbodjin",
                        title: "Scénariste - Série 'Nouvelles Générations'",
                        votes: 621,
                        image: "https://randomuser.me/api/portraits/men/42.jpg",
                        description: "Écriture contemporaine et engagée, dialogue percutant et réaliste."
                    }
                ]
            },
            {
                id: 'arts',
                name: 'Arts Visuels',
                icon: 'fa-paint-brush',
                nominees: [{
                        id: 8,
                        name: "Sarah Mensah",
                        title: "Peintre - Collection 'Renaissance'",
                        votes: 756,
                        image: "https://randomuser.me/api/portraits/women/68.jpg",
                        description: "Artiste plasticienne engagée pour l'environnement, techniques mixtes innovantes."
                    },
                    {
                        id: 9,
                        name: "Léa Yayi",
                        title: "Sculptrice - Installation 'Métamorphose'",
                        votes: 432,
                        image: "https://randomuser.me/api/portraits/women/51.jpg",
                        description: "Travaille les matériaux recyclés avec brio, message écologique fort."
                    },
                    {
                        id: 10,
                        name: "David Ouedraogo",
                        title: "Photographe - Exposition 'Regards Croisés'",
                        votes: 567,
                        image: "https://randomuser.me/api/portraits/men/65.jpg",
                        description: "Photographie documentaire poignante, témoin de son époque."
                    }
                ]
            },
            {
                id: 'danse',
                name: 'Danse & Chorégraphie',
                icon: 'fa-child',
                nominees: [{
                        id: 11,
                        name: "Sékou Traoré",
                        title: "Chorégraphe - Spectacle 'Rythmes Urbains'",
                        votes: 345,
                        image: "https://randomuser.me/api/portraits/men/55.jpg",
                        description: "Fusion innovante de danses traditionnelles et contemporaines."
                    },
                    {
                        id: 12,
                        name: "Aïcha Bamba",
                        title: "Danseuse - Compagnie 'Mouvements'",
                        votes: 289,
                        image: "https://randomuser.me/api/portraits/women/22.jpg",
                        description: "Technique impeccable, expressivité remarquable sur scène."
                    }
                ]
            },
            {
                id: 'litterature',
                name: 'Littérature',
                icon: 'fa-book',
                nominees: [{
                        id: 13,
                        name: "Moussa Konaté",
                        title: "Écrivain - Roman 'Les Chemins de la Mémoire'",
                        votes: 421,
                        image: "https://randomuser.me/api/portraits/men/45.jpg",
                        description: "Style littéraire puissant, exploration des identités africaines."
                    },
                    {
                        id: 14,
                        name: "Fatimata Sow",
                        title: "Poétesse - Recueil 'Murmures du Sahel'",
                        votes: 378,
                        image: "https://randomuser.me/api/portraits/women/39.jpg",
                        description: "Poésie engagée, voix forte des femmes africaines contemporaines."
                    }
                ]
            },
            {
                id: 'special',
                name: 'Prix Spéciaux',
                icon: 'fa-heart',
                nominees: [{
                        id: 15,
                        name: "Samuel Gnon",
                        title: "Mécène - Prix Cœur d'Or",
                        votes: 567,
                        image: "https://randomuser.me/api/portraits/men/55.jpg",
                        description: "Engagement exceptionnel pour les jeunes artistes, fondation d'insertion."
                    },
                    {
                        id: 16,
                        name: "Mariam Sékou",
                        title: "Éducatrice - Prix de l'Innovation Sociale",
                        votes: 389,
                        image: "https://randomuser.me/api/portraits/women/72.jpg",
                        description: "Projet d'éducation artistique pour 500 enfants défavorisés."
                    },
                    {
                        id: 17,
                        name: "Centre Culturel Lokossa",
                        title: "Institution - Prix du Développement Culturel",
                        votes: 456,
                        image: "https://images.unsplash.com/photo-1562774053-701939374585?ixlib=rb-4.0.3&auto=format&fit=crop&w=200&q=80",
                        description: "Programme d'ateliers artistiques gratuits pour la communauté."
                    }
                ]
            }
        ];

        // Variables globales
        let userVotes = JSON.parse(localStorage.getItem('userVotes')) || {};
        let currentNomineeId = null;
        let currentCategoryId = null;

        // Initialiser l'interface
        initializeVotingPage();

        function initializeVotingPage() {
            renderCategories();
            renderMyVotes();
            updateVotesCount();
        }

        // Rendre les catégories
        function renderCategories() {
            const tabsContainer = document.getElementById('categoriesTabs');
            const contentContainer = document.getElementById('categoriesContent');

            // Générer les onglets
            tabsContainer.innerHTML = categoriesData.map((category, index) => `
                <button class="category-tab ${index === 0 ? 'active' : ''}" 
                        data-category="${category.id}"
                        onclick="switchCategory('${category.id}')">
                    <i class="fas ${category.icon}"></i> ${category.name}
                </button>
            `).join('');

            // Générer le contenu
            contentContainer.innerHTML = categoriesData.map((category, index) => `
                <div class="category-content ${index === 0 ? 'active' : ''}" id="category-${category.id}">
                    <div class="nominees-grid">
                        ${category.nominees.map(nominee => {
                            const hasVoted = userVotes[category.id] === nominee.id;
                            return `
                                <div class="nominee-item fade-in">
                                    <div class="nominee-header">
                                        <img src="${nominee.image}" alt="${nominee.name}" class="nominee-avatar">
                                        <div class="nominee-info">
                                            <h4>${nominee.name}</h4>
                                            <p>${nominee.title}</p>
                                        </div>
                                    </div>
                                    <div class="nominee-body">
                                        <p class="nominee-description">${nominee.description}</p>
                                        <div class="nominee-stats">
                                            <div class="votes-count">
                                                <i class="fas fa-heart"></i> ${nominee.votes.toLocaleString()} votes
                                            </div>
                                            <button class="vote-btn ${hasVoted ? 'voted' : ''}" 
                                                    data-nominee="${nominee.id}"
                                                    data-category="${category.id}"
                                                    onclick="openVoteModal(${nominee.id}, '${category.id}')"
                                                    ${hasVoted ? 'disabled' : ''}>
                                                ${hasVoted ? '<i class="fas fa-check"></i> Déjà voté' : '<i class="fas fa-vote-yea"></i> Voter'}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }).join('')}
                    </div>
                </div>
            `).join('');
        }

        // Changer de catégorie
        window.switchCategory = function(categoryId) {
            // Mettre à jour les onglets
            document.querySelectorAll('.category-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelector(`.category-tab[data-category="${categoryId}"]`).classList.add('active');

            // Mettre à jour le contenu
            document.querySelectorAll('.category-content').forEach(content => {
                content.classList.remove('active');
            });
            document.getElementById(`category-${categoryId}`).classList.add('active');
        };

        // Ouvrir le modal de vote
        window.openVoteModal = function(nomineeId, categoryId) {
            currentNomineeId = nomineeId;
            currentCategoryId = categoryId;

            const category = categoriesData.find(c => c.id === categoryId);
            const nominee = category.nominees.find(n => n.id === nomineeId);

            if (!category || !nominee) return;

            // Mettre à jour le modal
            document.getElementById('modalNomineeImage').src = nominee.image;
            document.getElementById('modalNomineeName').textContent = nominee.name;
            document.getElementById('modalNomineeCategory').textContent = `Catégorie ${category.name}`;
            document.getElementById('modalNomineeTitle').textContent = nominee.title;

            // Afficher le modal
            document.getElementById('voteModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        // Confirmer le vote
        document.getElementById('confirmVote').addEventListener('click', function() {
            if (!currentNomineeId || !currentCategoryId) return;

            const category = categoriesData.find(c => c.id === currentCategoryId);
            const nominee = category.nominees.find(n => n.id === currentNomineeId);

            if (category && nominee) {
                // Mettre à jour les votes de l'utilisateur
                userVotes[currentCategoryId] = currentNomineeId;
                localStorage.setItem('userVotes', JSON.stringify(userVotes));

                // Augmenter le compteur de votes du nominé
                nominee.votes++;

                // Mettre à jour l'affichage
                updateNomineeButton(currentNomineeId, currentCategoryId);
                renderMyVotes();
                updateVotesCount();

                // Animation de confirmation
                const voteBtn = document.querySelector(`.vote-btn[data-nominee="${currentNomineeId}"][data-category="${currentCategoryId}"]`);
                if (voteBtn) {
                    voteBtn.classList.add('pulse');
                    setTimeout(() => voteBtn.classList.remove('pulse'), 500);
                }

                // Afficher un message de confirmation
                showNotification(`Vous avez voté pour ${nominee.name} dans la catégorie ${category.name}`);
            }

            // Fermer le modal
            closeVoteModal();
        });

        // Annuler le vote
        document.getElementById('cancelVote').addEventListener('click', closeVoteModal);

        // Fermer le modal
        function closeVoteModal() {
            document.getElementById('voteModal').classList.remove('active');
            document.body.style.overflow = 'auto';
            currentNomineeId = null;
            currentCategoryId = null;
        }

        // Mettre à jour le bouton de vote
        function updateNomineeButton(nomineeId, categoryId) {
            const voteBtn = document.querySelector(`.vote-btn[data-nominee="${nomineeId}"][data-category="${categoryId}"]`);
            if (voteBtn) {
                voteBtn.innerHTML = '<i class="fas fa-check"></i> Déjà voté';
                voteBtn.classList.add('voted');
                voteBtn.disabled = true;
            }

            // Désactiver les autres boutons dans la même catégorie
            const otherBtns = document.querySelectorAll(`.vote-btn[data-category="${categoryId}"]:not([data-nominee="${nomineeId}"])`);
            otherBtns.forEach(btn => {
                btn.innerHTML = '<i class="fas fa-vote-yea"></i> Voter';
                btn.classList.remove('voted');
                btn.disabled = false;
            });
        }

        // Rendre la liste des votes
        function renderMyVotes() {
            const votesList = document.getElementById('votesList');
            const noVotesMessage = document.getElementById('noVotesMessage');
            const submitBtn = document.getElementById('submitVotes');

            const voteEntries = Object.entries(userVotes);

            if (voteEntries.length === 0) {
                noVotesMessage.style.display = 'block';
                submitBtn.disabled = true;
                return;
            }

            noVotesMessage.style.display = 'none';
            submitBtn.disabled = false;

            votesList.innerHTML = voteEntries.map(([categoryId, nomineeId]) => {
                const category = categoriesData.find(c => c.id === categoryId);
                const nominee = category?.nominees.find(n => n.id === nomineeId);

                if (!category || !nominee) return '';

                return `
                    <div class="vote-item">
                        <div class="vote-nominee-info">
                            <img src="${nominee.image}" alt="${nominee.name}" class="vote-nominee-avatar">
                            <div class="vote-nominee-details">
                                <h4>${nominee.name}</h4>
                                <p>${nominee.title}</p>
                            </div>
                        </div>
                        <div class="vote-category">${category.name}</div>
                        <button class="remove-vote" onclick="removeVote('${categoryId}')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;
            }).join('');
        }

        // Retirer un vote
        window.removeVote = function(categoryId) {
            if (confirm("Êtes-vous sûr de vouloir retirer ce vote ?")) {
                delete userVotes[categoryId];
                localStorage.setItem('userVotes', JSON.stringify(userVotes));

                renderMyVotes();
                updateVotesCount();

                // Réactiver le bouton de vote
                const voteBtns = document.querySelectorAll(`.vote-btn[data-category="${categoryId}"]`);
                voteBtns.forEach(btn => {
                    btn.innerHTML = '<i class="fas fa-vote-yea"></i> Voter';
                    btn.classList.remove('voted');
                    btn.disabled = false;
                });

                showNotification('Vote retiré avec succès');
            }
        };

        // Tout effacer
        document.getElementById('resetVotes').addEventListener('click', function() {
            if (Object.keys(userVotes).length === 0) {
                showNotification('Aucun vote à effacer');
                return;
            }

            if (confirm("Êtes-vous sûr de vouloir effacer tous vos votes ? Cette action est irréversible.")) {
                userVotes = {};
                localStorage.setItem('userVotes', JSON.stringify(userVotes));

                renderMyVotes();
                updateVotesCount();

                // Réactiver tous les boutons de vote
                document.querySelectorAll('.vote-btn').forEach(btn => {
                    btn.innerHTML = '<i class="fas fa-vote-yea"></i> Voter';
                    btn.classList.remove('voted');
                    btn.disabled = false;
                });

                showNotification('Tous vos votes ont été effacés');
            }
        });

        // Mettre à jour le compteur de votes
        function updateVotesCount() {
            const votesCount = Object.keys(userVotes).length;
            document.getElementById('votesCount').textContent = `(${votesCount} vote${votesCount > 1 ? 's' : ''})`;
            document.getElementById('votedCategories').textContent = votesCount;
        }

        // Soumettre les votes
        document.getElementById('submitVotes').addEventListener('click', function() {
            if (Object.keys(userVotes).length === 0) {
                showNotification('Veuillez voter avant de soumettre');
                return;
            }

            // Simuler la soumission
            const submitBtn = document.getElementById('submitVotes');
            const originalText = submitBtn.innerHTML;

            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Soumission...';
            submitBtn.disabled = true;

            setTimeout(() => {
                // Enregistrer la soumission
                const submission = {
                    votes: userVotes,
                    timestamp: new Date().toISOString(),
                    submissionId: `SUB-${Date.now()}-${Math.random().toString(36).substr(2, 9)}`
                };

                localStorage.setItem('voteSubmission', JSON.stringify(submission));
                localStorage.setItem('submittedVotes', JSON.stringify(userVotes));

                // Afficher la confirmation
                alert(`✅ Vos votes ont été soumis avec succès !\n\nNuméro de soumission : ${submission.submissionId}\n\nMerci de votre participation !\n\nLes résultats seront annoncés lors de la cérémonie du 14 février 2026.`);

                // Réinitialiser le bouton
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = true;

                // Bloquer les votes supplémentaires
                document.querySelectorAll('.vote-btn').forEach(btn => {
                    btn.disabled = true;
                    btn.style.opacity = '0.6';
                });

                showNotification('Votes soumis avec succès !', 'success');
            }, 2000);
        });

        // Afficher une notification
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            notification.innerHTML = `
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
                <span>${message}</span>
            `;

            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background: ${type === 'success' ? '#4caf50' : 'var(--primary-color)'};
                color: white;
                padding: 15px 25px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.2);
                display: flex;
                align-items: center;
                gap: 10px;
                z-index: 10000;
                animation: slideIn 0.3s ease;
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease forwards';
                setTimeout(() => notification.remove(), 300);
            }, 3000);

            // Ajouter les styles d'animation si nécessaire
            if (!document.querySelector('#notification-styles')) {
                const style = document.createElement('style');
                style.id = 'notification-styles';
                style.textContent = `
                    @keyframes slideIn {
                        from { transform: translateX(100%); opacity: 0; }
                        to { transform: translateX(0); opacity: 1; }
                    }
                    @keyframes slideOut {
                        from { transform: translateX(0); opacity: 1; }
                        to { transform: translateX(100%); opacity: 0; }
                    }
                `;
                document.head.appendChild(style);
            }
        }

        // Vérifier si des votes ont déjà été soumis
        function checkPreviousSubmission() {
            const submission = localStorage.getItem('voteSubmission');
            if (submission) {
                const submittedVotes = JSON.parse(localStorage.getItem('submittedVotes') || '{}');
                if (Object.keys(submittedVotes).length > 0) {
                    // Restaurer les votes soumis
                    userVotes = submittedVotes;

                    // Désactiver tous les boutons
                    document.querySelectorAll('.vote-btn').forEach(btn => {
                        btn.disabled = true;
                        btn.style.opacity = '0.6';
                    });

                    // Afficher un message
                    const submitBtn = document.getElementById('submitVotes');
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fas fa-check"></i> Votes déjà soumis';

                    showNotification('Vos votes ont déjà été soumis. Merci pour votre participation !', 'success');

                    renderMyVotes();
                    updateVotesCount();
                }
            }
        }

        // Animation au défilement
        const animateOnScroll = () => {
            const cards = document.querySelectorAll('.step-card, .nominee-item');
            const windowHeight = window.innerHeight;

            cards.forEach(card => {
                const cardTop = card.getBoundingClientRect().top;
                if (cardTop < windowHeight * 0.9) {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }
            });
        };

        // Initialiser l'état des cartes animées
        document.querySelectorAll('.step-card, .nominee-item').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        });

        // Écouter le défilement
        window.addEventListener('scroll', animateOnScroll);
        // Initialiser une première fois
        animateOnScroll();

        // Vérifier les soumissions précédentes
        checkPreviousSubmission();

        // Fermer le modal en cliquant à l'extérieur
        document.getElementById('voteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeVoteModal();
            }
        });
    });
</script>
@endsection