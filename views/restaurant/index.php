<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nos Restaurants</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/restaurant.css">
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
               <!-- <a href="index.php?controller=user&action=index">Mon compte</a> -->
                <a href="index.php?controller=user&action=logout">Déconnexion</a>
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
                        <a href="index.php?controller=restaurant&action=update&id=<?php echo $restaurant->getId(); ?>" class="btn">Modifier</a>
                        <form action="index.php?controller=restaurant&action=delete&id=<?php echo $restaurant->getId(); ?>" method="POST" class="form-delete">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce restaurant ?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Lien "Ajouter un restaurant" en bas de page -->
        <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'restaurateur'): ?>
            <div class="add-restaurant">
                <a href="index.php?controller=restaurant&action=create" class="btn">Ajouter un restaurant</a>
            </div>
        <?php endif; ?>
    </main>
</body>
</html>