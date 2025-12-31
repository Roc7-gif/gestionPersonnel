@extends('layout') 
@section('title', 'Connexion - La ROUR 2026')

@section('style')
<style>
    .auth-section {
        padding: 80px 0;
        background: linear-gradient(135deg, rgba(233, 30, 99, 0.05), rgba(156, 39, 176, 0.05));
        min-height: 80vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .auth-card {
        background: var(--white);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
        position: relative;
        overflow: hidden;
    }

    .auth-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 5px;
        background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    }

    .auth-title {
        text-align: center;
        margin-bottom: 30px;
        font-family: 'Playfair Display', serif;
        font-size: 32px;
        color: var(--dark-color);
    }

    .form-group {
        margin-bottom: 20px;
        position: relative;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--dark-color);
        font-size: 14px;
    }

    .input-wrapper {
        position: relative;
    }

    .input-wrapper i {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--medium-gray);
        transition: var(--transition);
    }

    .form-control {
        width: 100%;
        padding: 12px 15px 12px 45px;
        border: 2px solid #eee;
        border-radius: 10px;
        font-family: 'Poppins', sans-serif;
        font-size: 15px;
        transition: var(--transition);
        outline: none;
    }

    .form-control:focus {
        border-color: var(--primary-color);
    }

    .form-control:focus + i {
        color: var(--primary-color);
    }

    .form-options {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        font-size: 13px;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 5px;
        cursor: pointer;
    }

    .forgot-link {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 500;
    }

    .btn-auth {
        width: 100%;
        padding: 14px;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        color: var(--white);
        border: none;
        border-radius: 30px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 5px 15px rgba(233, 30, 99, 0.3);
    }

    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(233, 30, 99, 0.4);
    }

    .auth-footer {
        text-align: center;
        margin-top: 25px;
        font-size: 14px;
        color: var(--medium-gray);
    }

    .auth-footer a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
    }

    /* Checkbox custom style */
    input[type="checkbox"] {
        accent-color: var(--primary-color);
    }
</style>
@endsection

@section('body')
<section class="auth-section">
    <div class="container fade-in-up" style="display: flex; justify-content: center;">
        <div class="auth-card">
            <h2 class="auth-title">Connexion</h2>
            
            <form action="{{ route('login') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="email">Adresse Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" class="form-control" placeholder="exemple@email.com" required>
                        <i class="fas fa-envelope"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" class="form-control" placeholder="Votre mot de passe" required>
                        <i class="fas fa-lock"></i>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember"> Se souvenir de moi
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="forgot-link">Mot de passe oublié ?</a>
                    @endif
                </div>

                <button type="submit" class="btn-auth">
                    Se connecter <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                </button>
            </form>

            <div class="auth-footer">
                <p>Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire à La ROUR</a></p>
            </div>
        </div>
    </div>
</section>
@endsection