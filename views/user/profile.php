<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/accueil.css">
    <style>
        html, body { margin: 0; padding: 0; }
        header { margin: 0; }
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

        .profile-wrapper {
            max-width: 760px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0,0,0,.08);
            padding: 28px;
        }

        .profile-wrapper h2 {
            color: #e63946;
            margin-bottom: 18px;
            text-align: center;
        }

        .profile-form .row { margin-bottom: 14px; }
        .profile-form label { display: block; font-weight: 700; margin-bottom: 6px; }
        .profile-form input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        .profile-form small { color: #555; display: block; margin-top: 6px; }

        .btn-submit {
            background: #e63946;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px 16px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-submit:hover { background: #d62839; }

        .alert-success {
            background: #d1e7dd;
            border: 1px solid #badbcc;
            color: #0f5132;
            border-radius: 8px;
            padding: 10px 12px;
            margin-bottom: 14px;
        }

        .alert-error {
            background: #f8d7da;
            border: 1px solid #f5c2c7;
            color: #842029;
            border-radius: 8px;
            padding: 10px 12px;
            margin-bottom: 14px;
        }
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
            <a class="logout-link" href="index.php?controller=user&action=logout">Déconnexion</a>
            <a class="account-link" href="index.php?controller=user&action=profile" title="Mon compte" aria-label="Mon compte">
                <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                    <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"></path>
                </svg>
            </a>
        </nav>
    </header>

    <section class="profile-wrapper">
        <h2>Mon compte</h2>

        <?php if (!empty($successMessage)): ?>
            <div class="alert-success"><?php echo htmlspecialchars($successMessage); ?></div>
        <?php endif; ?>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert-error"><?php echo htmlspecialchars($errorMessage); ?></div>
        <?php endif; ?>

        <form class="profile-form" action="index.php?controller=user&action=profile" method="POST">
            <div class="row">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required value="<?php echo htmlspecialchars($user->getNom()); ?>">
            </div>

            <div class="row">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" required value="<?php echo htmlspecialchars($user->getPrenom()); ?>">
            </div>

            <div class="row">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required value="<?php echo htmlspecialchars($user->getEmail()); ?>">
            </div>

            <div class="row">
                <label for="new_password">Nouveau mot de passe (optionnel) :</label>
                <input type="password" id="new_password" name="new_password"
                       pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,}"
                       title="Au moins 8 caractères avec majuscule, minuscule, chiffre et caractère spécial.">
                <small>Laissez vide pour conserver le mot de passe actuel.</small>
            </div>

            <div class="row">
                <label for="confirm_password">Confirmer le mot de passe :</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>

            <button class="btn-submit" type="submit">Mettre à jour mes informations</button>
        </form>
    </section>
</body>
</html>
