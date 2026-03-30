<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Restaurant</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/style.css">
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
                <span style="margin-left:10px;font-weight:700;color:#0f2f5a;">Connecté<?php if ($role !== ''): ?> (<?php echo htmlspecialchars($role); ?>)<?php endif; ?></span>
                <a href="index.php?controller=user&action=logout">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?controller=user&action=login">Connexion</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <h2>Détails du restaurant</h2>
        <h3><?php echo htmlspecialchars($restaurant->getNom()); ?></h3>
        <p>Ville : <?php echo htmlspecialchars($restaurant->getVille()); ?></p>
        <p>Adresse : <?php echo htmlspecialchars($restaurant->getAdresse()); ?></p>
        <p>Code Postal : <?php echo htmlspecialchars($restaurant->getCodePostal()); ?></p>

        <p>
            <?php if ($isAdmin): ?>
                <a href="index.php?controller=restaurant&action=update&id=<?php echo $restaurant->getId(); ?>">Modifier le restaurant</a>
                |
            <?php endif; ?>
            <a href="index.php?controller=restaurant&action=index">Retour à la liste</a>
        </p>

        <?php if ($isAdmin): ?>
            <!-- Formulaire de suppression -->
            <form action="index.php?controller=restaurant&action=delete&id=<?php echo $restaurant->getId(); ?>" method="POST">
                <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce restaurant ?')">Supprimer le restaurant</button>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>