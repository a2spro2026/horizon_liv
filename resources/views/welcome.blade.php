<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion — Horizon Post</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|outfit:500,600,700" rel="stylesheet" />
    <style>
        :root {
            --navy: #0b1628;
            --navy-soft: rgba(11, 22, 40, 0.82);
            --orange: #f26522;
            --orange-hover: #e05512;
            --white: #ffffff;
            --muted: rgba(255, 255, 255, 0.72);
            --field: rgba(255, 255, 255, 0.1);
            --field-border: rgba(255, 255, 255, 0.22);
            --radius: 14px;
            --success: #2ecc71;
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            min-height: 100vh;
            font-family: "DM Sans", system-ui, sans-serif;
            color: var(--white);
            background:
                linear-gradient(105deg, rgba(8, 14, 28, 0.35) 0%, rgba(8, 14, 28, 0.08) 45%, rgba(8, 14, 28, 0.22) 100%),
                url("{{ asset('images/horizon-bg.png') }}") center / cover no-repeat fixed;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 0;
            overflow-x: hidden;
        }

        .panel {
            width: min(100%, 420px);
            margin: 1.25rem clamp(1rem, 6vw, 5rem) 1.25rem 1rem;
            padding: 1.85rem 1.75rem 1.85rem;
            border-radius: 20px;
            background: var(--navy-soft);
            border: 1px solid rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.35);
            animation: rise 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
            max-height: calc(100vh - 2.5rem);
            overflow-y: auto;
        }

        .panel.register-panel {
            width: min(100%, 480px);
            display: none;
        }

        .panel.is-visible { display: block; }
        .panel.is-hidden { display: none; }

        .panel h1 {
            font-family: "Outfit", sans-serif;
            font-size: 1.55rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 0.3rem;
        }

        .panel .subtitle {
            color: var(--muted);
            font-size: 0.92rem;
            margin-bottom: 1.35rem;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            margin-bottom: 0.95rem;
        }

        .field label {
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.85);
        }

        .field label .req { color: var(--orange); }

        .field input,
        .field select {
            width: 100%;
            appearance: none;
            -webkit-appearance: none;
            border: 1px solid var(--field-border);
            background: var(--field);
            color: var(--white);
            border-radius: var(--radius);
            padding: 0.8rem 1rem;
            font-size: 0.98rem;
            outline: none;
            transition: border-color 0.2s ease, background 0.2s ease, box-shadow 0.2s ease;
        }

        .field select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23ffffff' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 1rem center;
            padding-right: 2.5rem;
            cursor: pointer;
        }

        .field select option { color: #0b1628; background: #fff; }
        .field input::placeholder { color: rgba(255, 255, 255, 0.45); }

        .field input:focus,
        .field select:focus {
            border-color: var(--orange);
            background: rgba(255, 255, 255, 0.14);
            box-shadow: 0 0 0 3px rgba(242, 101, 34, 0.25);
        }

        .field-error {
            color: #ff8f7a;
            font-size: 0.8rem;
            margin-top: -0.55rem;
            margin-bottom: 0.75rem;
        }

        .btn {
            width: 100%;
            margin-top: 0.35rem;
            border: none;
            border-radius: var(--radius);
            background: var(--orange);
            color: var(--white);
            font-family: "Outfit", sans-serif;
            font-size: 1rem;
            font-weight: 600;
            padding: 0.95rem 1rem;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.15s ease;
        }

        .btn:hover { background: var(--orange-hover); }
        .btn:active { transform: scale(0.985); }

        .btn-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0.75rem;
            margin-top: 0.35rem;
        }

        .btn-row .btn { margin-top: 0; }

        .btn-cancel {
            background: transparent;
            border: 1px solid var(--field-border);
            color: var(--white);
        }

        .btn-cancel:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .switch-auth {
            margin-top: 1.15rem;
            text-align: center;
            font-size: 0.92rem;
            color: var(--muted);
        }

        .switch-auth button {
            background: none;
            border: none;
            color: var(--orange);
            font: inherit;
            font-weight: 600;
            cursor: pointer;
            text-decoration: underline;
            text-underline-offset: 3px;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.18);
            border: 1px solid rgba(46, 204, 113, 0.45);
            color: #d8ffe8;
            border-radius: 12px;
            padding: 0.9rem 1rem;
            margin-bottom: 1.15rem;
            font-size: 0.92rem;
            line-height: 1.45;
        }

        .register-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 0;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(18px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 720px) {
            body {
                justify-content: center;
                background-attachment: scroll;
                background-position: 65% center;
            }
            .panel { margin: 1rem; }
        }
    </style>
</head>
<body>
    <main id="login-panel" class="panel {{ session('register_success') || $errors->any() && old('_form') === 'register' ? 'is-hidden' : 'is-visible' }}" aria-label="Panneau de connexion">
        <h1>Connexion</h1>
        <p class="subtitle">Accédez à votre espace Horizon Post</p>

        @if (session('register_success'))
            <div class="alert-success">{{ session('register_success') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}" autocomplete="on">
            @csrf
            <input type="hidden" name="_form" value="login">

            <div class="field">
                <label for="statut">Statut</label>
                <select id="statut" name="statut" required>
                    <option value="" disabled>Choisir un statut</option>
                    <option value="admin" @selected(old('statut', 'admin') === 'admin')>Administrateur</option>
                    <option value="client" @selected(old('statut') === 'client')>Client</option>
                    <option value="livreur" @selected(old('statut') === 'livreur')>Livreur</option>
                    <option value="agence" @selected(old('statut') === 'agence')>Agence</option>
                </select>
            </div>

            <div class="field">
                <label for="login">Login</label>
                <input
                    id="login"
                    type="text"
                    name="login"
                    value="{{ old('login', 'admin@horizonliv.com') }}"
                    placeholder="Email ou identifiant"
                    required
                    autocomplete="username"
                >
            </div>

            <div class="field">
                <label for="password">Mot de passe</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    value="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
            </div>

            <button type="submit" class="btn">Se connecter</button>
        </form>

        <p class="switch-auth">
            Pas encore de compte ?
            <button type="button" id="open-register">Inscrivez-vous</button>
        </p>
    </main>

    <main id="register-panel" class="panel register-panel {{ $errors->any() && old('_form') === 'register' ? 'is-visible' : '' }}" aria-label="Panneau d'inscription">
        <h1>Inscription</h1>
        <p class="subtitle">Créez votre compte partenaire Horizon Post</p>

        <form method="POST" action="{{ route('register') }}" autocomplete="on" id="register-form">
            @csrf
            <input type="hidden" name="_form" value="register">

            <div class="register-grid">
                <div class="field">
                    <label for="nom_complet">Nom Complet <span class="req">*</span></label>
                    <input id="nom_complet" type="text" name="nom_complet" value="{{ old('nom_complet') }}" required>
                </div>
                @error('nom_complet')<div class="field-error">{{ $message }}</div>@enderror

                <div class="field">
                    <label for="telephone">Téléphone <span class="req">*</span></label>
                    <input
                        id="telephone"
                        type="tel"
                        name="telephone"
                        value="{{ old('telephone', '00212') }}"
                        placeholder="00212..."
                        pattern="00212[0-9]+"
                        title="Le numéro doit commencer par 00212"
                        required
                    >
                </div>
                @error('telephone')<div class="field-error">{{ $message }}</div>@enderror

                <div class="field">
                    <label for="email">E-mail <span class="req">*</span></label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                </div>
                @error('email')<div class="field-error">{{ $message }}</div>@enderror

                <div class="field">
                    <label for="ville">Ville <span class="req">*</span></label>
                    <input id="ville" type="text" name="ville" value="{{ old('ville') }}" required>
                </div>
                @error('ville')<div class="field-error">{{ $message }}</div>@enderror

                <div class="field">
                    <label for="reg_password">Mot de passe <span class="req">*</span></label>
                    <input id="reg_password" type="password" name="password" required minlength="10" placeholder="Au moins 10 caractères">
                </div>
                @error('password')<div class="field-error">{{ $message }}</div>@enderror

                <div class="field">
                    <label for="password_confirmation">Confirmer Mot de passe <span class="req">*</span></label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required minlength="10">
                </div>

                <div class="field">
                    <label for="magasin">Magasin <span class="req">*</span></label>
                    <input id="magasin" type="text" name="magasin" value="{{ old('magasin') }}" required>
                </div>
                @error('magasin')<div class="field-error">{{ $message }}</div>@enderror

                <div class="field">
                    <label for="cin">CIN <span class="req">*</span></label>
                    <input id="cin" type="text" name="cin" value="{{ old('cin') }}" required>
                </div>
                @error('cin')<div class="field-error">{{ $message }}</div>@enderror

                <div class="field">
                    <label for="banque">Banque <span class="req">*</span></label>
                    <input id="banque" type="text" name="banque" value="{{ old('banque') }}" required>
                </div>
                @error('banque')<div class="field-error">{{ $message }}</div>@enderror

                <div class="field">
                    <label for="rib">Rib <span class="req">*</span></label>
                    <input id="rib" type="text" name="rib" value="{{ old('rib') }}" required>
                </div>
                @error('rib')<div class="field-error">{{ $message }}</div>@enderror
            </div>

            <div class="btn-row">
                <button type="button" class="btn btn-cancel" id="cancel-register">Annuler</button>
                <button type="submit" class="btn">Envoyer</button>
            </div>
        </form>

        <p class="switch-auth">
            Déjà inscrit ?
            <button type="button" id="open-login">Se connecter</button>
        </p>
    </main>

    <script>
        const loginPanel = document.getElementById('login-panel');
        const registerPanel = document.getElementById('register-panel');
        const phone = document.getElementById('telephone');

        function showRegister() {
            loginPanel.classList.add('is-hidden');
            loginPanel.classList.remove('is-visible');
            registerPanel.classList.add('is-visible');
            registerPanel.style.display = 'block';
        }

        function showLogin() {
            registerPanel.classList.remove('is-visible');
            registerPanel.style.display = 'none';
            loginPanel.classList.remove('is-hidden');
            loginPanel.classList.add('is-visible');
        }

        document.getElementById('open-register').addEventListener('click', showRegister);
        document.getElementById('open-login').addEventListener('click', showLogin);
        document.getElementById('cancel-register').addEventListener('click', showLogin);

        phone.addEventListener('input', () => {
            if (!phone.value.startsWith('00212')) {
                phone.value = '00212' + phone.value.replace(/^0+/, '').replace(/^0212/, '');
                if (!phone.value.startsWith('00212')) {
                    phone.value = '00212';
                }
            }
        });

        phone.addEventListener('keydown', (e) => {
            if ((e.key === 'Backspace' || e.key === 'Delete') && phone.selectionStart <= 5) {
                if (phone.value.length <= 5) {
                    e.preventDefault();
                }
            }
        });

        @if ($errors->any() && old('_form') === 'register')
            showRegister();
        @endif

        @if (session('register_success'))
            showLogin();
        @endif
    </script>
</body>
</html>
