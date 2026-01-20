
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Plats - Sio Street</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/plat.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?controller=menu&action=index">Menus</a>
            <a href="index.php?controller=plat&action=index">Plats</a>
            <a href="index.php?controller=restaurant&action=index">Restaurants</a>
            <a href="index.php?controller=contact&action=index">Contact</a>
            <?php if (isset($_SESSION['user_id'])): ?>
              <!--  <a href="index.php?controller=user&action=index">Mon compte</a> -->
                <a href="index.php?controller=user&action=logout">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?controller=user&action=login">Connexion</a>
                <a href="index.php?controller=user&action=register">Inscription</a>
            <?php endif; ?>
        </nav>
    </header>

    <main>
        <h1>Nos Plats</h1>
        <div class="plats-container">
            <?php foreach ($plats as $plat): ?>
                <div class="plat-card">
                    <?php if ($plat->getImage()): ?>
                        <img src="<?= htmlspecialchars($plat->getImage()); ?>" alt="Image de <?= htmlspecialchars($plat->getNom()); ?>" class="plat-image">
                    <?php else: ?>
                        <img src="/site_restaurant_mvc_v2_correct/images/default-plat.jpg" alt="Image par défaut" class="plat-image">
                    <?php endif; ?>
                    <h3><?= htmlspecialchars($plat->getNom()); ?></h3>
                    <p><?= number_format($plat->getPrix(), 2, ',', ' '); ?> €</p>
                    <div class="actions">
                        <a href="index.php?controller=plat&action=show&id=<?= $plat->getId(); ?>" class="btn">Voir</a>
                        <a href="index.php?controller=plat&action=update&id=<?= $plat->getId(); ?>" class="btn update">Modifier</a>
                        <a href="index.php?controller=plat&action=delete&id=<?= $plat->getId(); ?>" class="btn delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce plat ?');">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="btn-container">
            <a href="index.php?controller=plat&action=create&menuId=<?= htmlspecialchars($_GET['menuId'] ?? '') ?>" class="cta-button">Ajouter un Plat</a>
        </div>
    </main>

    <footer>
        <p>&copy; 2025 Sio Street | Tous droits réservés</p>
    </footer>
</body>
</html>