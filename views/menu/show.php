<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du menu</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/indexmenu.css">
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
        }
        .account-link svg { width: 26px; height: 26px; fill: #000; }
        .menu-image { width: 100%; max-width: 220px; height: 150px; object-fit: cover; border-radius: 8px; margin-bottom: 10px; }
        .auth-state { margin-left: auto; font-weight: 700; color: #0f2f5a; }
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
        <h2>Détails du menu</h2>
        <div class="menus">
            <div class="card menu-details">
                <?php
                    $menuImage = $menu->getImage();
                    $fallbackImage = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="440" height="300" viewBox="0 0 440 300"><rect width="100%" height="100%" fill="#f2f2f2"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-size="22" fill="#9a9a9a">Image non disponible</text></svg>');
                ?>
                <img class="menu-image" src="<?php echo htmlspecialchars($menuImage ?: $fallbackImage); ?>" alt="<?php echo htmlspecialchars($menu->getNom()); ?>">
                <h3><?php echo htmlspecialchars($menu->getNom()); ?></h3>
                <p>Prix : <?php echo number_format($menu->getPrix(), 2, ',', ' '); ?> €</p>
                <p class="menu-description"><?php echo htmlspecialchars($menu->getDescription()); ?></p>

                <h3>Plats du menu</h3>
                <?php if (!empty($plats)): ?>
                    <ul>
                    <?php foreach ($plats as $plat): ?>
                        <li>
                            <?php echo htmlspecialchars($plat->getNom()); ?> - <?php echo number_format($plat->getPrix(), 2, ',', ' '); ?> €
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>Aucun plat associé à ce menu.</p>
                <?php endif; ?>

                <a href="index.php?controller=menu&action=index">Retour</a>
                <?php if ($isAdmin): ?>
                    <a href="index.php?controller=menu&action=update&id=<?php echo $menu->getId(); ?>">Modifier</a>
                    <a href="index.php?controller=menu&action=delete&id=<?php echo $menu->getId(); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu ?');">Supprimer</a>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>