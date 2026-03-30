<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Restaurant</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/style.css">
</head>
<body>
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?controller=menu&action=index">Menus</a>
            <a href="index.php?controller=plat&action=index">Plats</a>
            <a href="index.php?controller=restaurant&action=index">Restaurants</a>
            <a href="index.php?controller=contact&action=index">Contact</a>
            <a href="index.php?controller=panier&action=index">Panier</a>
        </nav>
    </header>

    <main>
        <h2>Modifier le restaurant : <?php echo htmlspecialchars($restaurant->getNom()); ?></h2>
        <form action="index.php?controller=restaurant&action=update&id=<?php echo $restaurant->getId(); ?>" method="POST">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($restaurant->getNom()); ?>" required>

            <label for="ville">Ville :</label>
            <input type="text" id="ville" name="ville" value="<?php echo htmlspecialchars($restaurant->getVille()); ?>" required>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo htmlspecialchars($restaurant->getAdresse()); ?>" required>

            <label for="codePostal">Code Postal :</label>
            <input type="text" id="codePostal" name="codePostal" value="<?php echo htmlspecialchars($restaurant->getCodePostal()); ?>" required>

            <button type="submit">Mettre à jour</button>
        </form>

        <p>
            <a href="index.php?controller=restaurant&action=index">Retour à la liste</a>
        </p>
    </main>
</body>
</html>