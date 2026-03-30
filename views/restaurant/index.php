<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Restaurants</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/restaurant.css">
    <style>
        html, body { margin: 0; padding: 0; }
        header { margin: 0; }
        header nav { display: flex; align-items: center; gap: 10px; }
        .logout-link { margin-left: 10px; }
        .auth-state { margin-left: auto; font-weight: 700; color: #0f2f5a; }
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
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $role = strtolower(trim((string)($_SESSION['user_role'] ?? '')));
        $isAdmin = isset($_SESSION['user_id']) && $role === 'admin';
    ?>
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

    <main>
        <h2>Tous les restaurants</h2>
        <div class="restaurants">
            <?php foreach ($restaurants as $restaurant): ?>
                <div class="card">
                    <h3><?php echo htmlspecialchars($restaurant->getNom()); ?></h3>
                    <p>Ville : <?php echo htmlspecialchars($restaurant->getVille()); ?></p>
                    <p>Adresse : <?php echo htmlspecialchars($restaurant->getAdresse()); ?></p>
                    <p>Code Postal : <?php echo htmlspecialchars($restaurant->getCodePostal()); ?></p>

                    <!-- Liens d'action -->
                    <div class="actions">
                        <a href="index.php?controller=restaurant&action=show&id=<?php echo $restaurant->getId(); ?>" class="btn">Voir</a>
                        <?php if ($isAdmin): ?>
                            <a href="index.php?controller=restaurant&action=update&id=<?php echo $restaurant->getId(); ?>" class="btn">Modifier</a>
                            <form action="index.php?controller=restaurant&action=delete&id=<?php echo $restaurant->getId(); ?>" method="POST" class="form-delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce restaurant ?')">Supprimer</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Lien "Ajouter un restaurant" en bas de page -->
        <?php if ($isAdmin): ?>
            <div class="add-restaurant">
                <a href="index.php?controller=restaurant&action=create" class="btn">Ajouter un restaurant</a>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>