<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Menus</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/indexmenu.css">
</head>
<body>
    <!-- En-tête -->
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

    <!-- Section principale -->
    <main>
        <h2>Liste des Menus</h2>
        <div class="menus">
            <?php foreach ($menus as $menu): ?>
                <div class="card">
                    <img src="<?php echo htmlspecialchars($menu->getImage()); ?>" alt="<?php echo htmlspecialchars($menu->getNom()); ?>" width="100">
                    <h3><?php echo htmlspecialchars($menu->getNom()); ?></h3>
                    <p>Prix : <?php echo number_format($menu->getPrix(), 2, ',', ' '); ?> €</p>
                    <a href="index.php?controller=menu&action=show&id=<?php echo $menu->getId(); ?>">Voir</a>
                    <a href="index.php?controller=menu&action=update&id=<?php echo $menu->getId(); ?>">Modifier</a>
                    <a href="index.php?controller=menu&action=delete&id=<?php echo $menu->getId(); ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu ?');">Supprimer</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <!-- Lien Ajouter un menu -->
    <footer>
        <a href="index.php?controller=menu&action=create" class="add-button">Ajouter un Menu</a>
    </footer>
</body>
</html>