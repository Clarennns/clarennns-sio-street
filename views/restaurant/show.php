<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Restaurant</title>
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?controller=menu&action=index">Menus</a>
            <a href="index.php?controller=plat&action=index">Plats</a>
            <a href="index.php?controller=restaurant&action=index">Restaurants</a>
            <a href="index.php?controller=contact&action=index">Contact</a>
        </nav>
    </header>

    <main>
        <h2>Détails du restaurant</h2>
        <h3><?php echo htmlspecialchars($restaurant->getNom()); ?></h3>
        <p>Ville : <?php echo htmlspecialchars($restaurant->getVille()); ?></p>
        <p>Adresse : <?php echo htmlspecialchars($restaurant->getAdresse()); ?></p>
        <p>Code Postal : <?php echo htmlspecialchars($restaurant->getCodePostal()); ?></p>
        
        <!-- Formulaire de suppression -->
        <form action="index.php?controller=restaurant&action=delete&id=<?php echo $restaurant->getId(); ?>" method="POST">
            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce restaurant ?')">Supprimer le restaurant</button>
        </form>
        
        <br>
        <a href="index.php?controller=restaurant&action=update&id=<?php echo $restaurant->getId(); ?>">Modifier le restaurant</a>
    </main>
</body>
</html>