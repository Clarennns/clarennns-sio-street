<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/accueil.css">
    <style>
        html, body { margin: 0; padding: 0; }
        header { margin: 0; }
        .auth-wrapper { max-width: 760px; margin: 40px auto; background: #fff; border-radius: 10px; box-shadow: 0 6px 20px rgba(0,0,0,.08); padding: 28px; }
        .auth-wrapper h2 { color: #e63946; margin-bottom: 18px; text-align: center; }
        .auth-form .row { margin-bottom: 14px; }
        .auth-form label { display: block; font-weight: 700; margin-bottom: 6px; }
        .auth-form input { width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 8px; }
        .auth-form small { color: #555; }
        .btn-submit { background: #e63946; color: #fff; border: none; border-radius: 8px; padding: 12px 16px; font-weight: 700; cursor: pointer; }
        .btn-submit:hover { background: #d62839; }
        header nav { display: flex; align-items: center; gap: 10px; }
        .logout-link { margin-left: auto; }
        .account-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: #ffffff;
            border-radius: 8px;
            border: 1px solid rgba(0, 0, 0, 0.15);
            text-decoration: none;
        }
        .account-link svg { width: 26px; height: 26px; fill: #000; }
    </style>
</head>
<body>
    <?php if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); } ?>
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?controller=menu&action=index">Menus</a>
            <a href="index.php?controller=plat&action=index">Plats</a>
            <a href="index.php?controller=restaurant&action=index">Restaurants</a>
            <a href="index.php?controller=contact&action=index">Contact</a>
            <a href="index.php?controller=panier&action=index">Panier</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <a class="logout-link" href="index.php?controller=user&action=logout">Déconnexion</a>
                <a class="account-link" href="index.php?controller=user&action=profile" title="Mon compte" aria-label="Mon compte">
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"></path>
                    </svg>
                </a>
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
                    <a href="index.php?controller=user&action=index">Utilisateurs</a>
                <?php endif; ?>
            <?php else: ?>
                <a href="index.php?controller=user&action=login">Connexion</a>
                <a href="index.php?controller=user&action=register">Inscription</a>
            <?php endif; ?>
        </nav>
    </header>

    <section class="auth-wrapper">
        <h2>Formulaire d'inscription</h2>
        <form class="auth-form" action="index.php?controller=user&action=register" method="POST">
            <div class="row">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" required>
            </div>
            
            <div class="row">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" required>
            </div>

            <div class="row">
            <label for="date_naissance">Date de naissance :</label>
            <input type="date" name="date_naissance" id="date_naissance" required>
            </div>

            <div class="row">
            <label for="adresse">Adresse :</label>
            <input type="text" name="adresse" id="adresse" required>
            </div>

            <div class="row">
            <label for="ville">Ville :</label>
            <input type="text" name="ville" id="ville" required>
            </div>

            <div class="row">
            <label for="code_postal">Code postal :</label>
            <input type="text" name="code_postal" id="code_postal" maxlength="10" required>
            </div>

            <div class="row">
            <label for="telephone">Numéro de téléphone :</label>
            <input type="text" name="telephone" id="telephone" maxlength="20" required>
            </div>

            <div class="row">
            <label for="email">Email :</label>
            <input type="email" name="email" id="email" required>
            </div>

            <div class="row">
            <label for="password">Mot de passe :</label>
                 <input type="password" name="password" id="password" required
                     pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,}"
                     title="Au moins 8 caractères avec majuscule, minuscule, chiffre et caractère spécial.">
                 <small>Au moins 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre, 1 caractère spécial.</small>
            </div>

            <button class="btn-submit" type="submit">S'inscrire</button>
        </form>
    </section>
</body>
</html>
