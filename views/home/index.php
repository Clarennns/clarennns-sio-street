<?php
// Démarre la session pour récupérer $_SESSION
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sio Street</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/accueil.css">
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
                <!-- Si connecté, affiche Mon compte et Déconnexion -->
             <!--   <a href="index.php?controller=user&action=index">Mon compte</a> -->
                <a href="index.php?controller=user&action=logout">Déconnexion</a>
            <?php else: ?>
                <!-- Sinon, affiche Connexion et Inscription -->
                <a href="index.php?controller=user&action=login">Connexion</a>
                <a href="index.php?controller=user&action=register">Inscription</a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- Histoire de la franchise -->
    <section class="story">
        <p><strong>Sio Street</strong> est née en 2024, avec l’ouverture de son premier restaurant dans le 14e arrondissement de Paris. Dès le départ, l’objectif était simple : offrir une expérience de poulet unique, rapide et savoureuse. Aujourd’hui, la franchise s’étend à travers la France, avec l’ambition de partager notre passion pour le poulet grillé et frit, tout en maintenant la qualité au cœur de nos recettes.</p>
    </section>

    <section class="hero">
        <div class="hero-content">
            <h1>Bienvenue chez Sio Street</h1>
            <p>Les meilleurs poulets de la ville. Savourez nos recettes uniques!</p>
            <a href="index.php?controller=menu&action=index" class="cta-button">Voir nos Menus</a>
        </div>
    </section>

    <section>
        <h2>Nos Restaurants</h2>
        <div class="restaurants">
            <?php foreach ($restaurants as $restaurant): ?>
                <div class="restaurant">
                    <h3><?php echo htmlspecialchars($restaurant->getNom()); ?></h3>
                    <p>Ville : <?php echo htmlspecialchars($restaurant->getVille()); ?></p>
                    <p>Adresse : <?php echo htmlspecialchars($restaurant->getAdresse()); ?></p>
                    <p>Code Postal : <?php echo htmlspecialchars($restaurant->getCodePostal()); ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="btn-container">
            <a href="index.php?controller=restaurant&action=index" class="cta-button">Voir Tous Nos Restaurants</a>
        </div>
    </section>

    <footer>
        <p>&copy; 2025 Sio Street | Tous droits réservés</p>
    </footer>
</body>
</html>