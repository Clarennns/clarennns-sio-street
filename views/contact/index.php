<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/contact.css">
    <style>
        html, body { margin: 0; padding: 0; }
        header { margin: 0; }
        header nav { display: flex; align-items: center; gap: 10px; }
        .logout-link { margin-left: 10px; }
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
            padding: 0;
        }
        .account-link svg { width: 26px; height: 26px; fill: #000; }
        .auth-state { margin-left: auto; font-weight: 700; color: #0f2f5a; }
    </style>
</head>
<body>
    <?php
        if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
        $role = strtolower(trim((string)($_SESSION['user_role'] ?? '')));
    ?>

    <!-- Bandeau de navigation -->
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?controller=menu&action=index">Menus</a>
            <a href="index.php?controller=plat&action=index">Plats</a>
            <a href="index.php?controller=restaurant&action=index">Restaurants</a>
            <a href="index.php?controller=contact&action=index">Contact</a>
            <a href="index.php?controller=panier&action=index">Panier</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span class="auth-state">Connecté<?php if ($role !== ''): ?> (<?php echo htmlspecialchars($role); ?>)<?php endif; ?></span>
                <a class="logout-link" href="index.php?controller=user&action=logout">Déconnexion</a>
                <a class="account-link" href="index.php?controller=user&action=profile" title="Mon compte" aria-label="Mon compte">
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"></path>
                    </svg>
                </a>
            <?php else: ?>
                <a href="index.php?controller=user&action=login">Connexion</a>
                <a href="index.php?controller=user&action=register">Inscription</a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- Formulaire de contact -->
    <main>
        <h2>Contactez-nous</h2>
        <form method="post" action="index.php?controller=contact&action=send">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="numero">Numéro de téléphone :</label>
                <input type="tel" id="numero" name="numero" maxlength="20" placeholder="Ex : 0612345678">
            </div>
            <div>
                <label for="message">Message :</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div>
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Sio Street</p>
    </footer>

</body>
</html>
