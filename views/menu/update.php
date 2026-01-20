
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Menu</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/editmenu.css">
</head>
<body>
    <!-- En-tête avec navigation -->
    <header>
        <h1>Modifier le Menu : <?php echo htmlspecialchars($menu->getNom()); ?></h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?controller=menu&action=index">Menus</a>
        </nav>
    </header>

    <section>
        <h2>Formulaire de Modification</h2>
        <form action="index.php?controller=menu&action=update&id=<?php echo $menu->getId(); ?>" method="POST" enctype="multipart/form-data">
            <div>
                <label for="nom">Nom du Menu :</label>
                <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($menu->getNom()); ?>" required>
            </div>

            <div>
                <label for="prix">Prix :</label>
                <input type="number" name="prix" id="prix" step="0.01" value="<?php echo number_format($menu->getPrix(), 2, ',', ' '); ?>" required>
            </div>

            <div>
                <label for="image">Image du Menu :</label>
                <input type="file" name="image" id="image">
                <p>Image actuelle :</p>
                <img src="<?php echo htmlspecialchars($menu->getImage()); ?>" alt="Image du menu" width="200">
            </div>

            <div>
                <button type="submit">Mettre à jour le Menu</button>
            </div>
        </form>
    </section>

    <footer>
        <a href="index.php?controller=menu&action=index">Retour à la liste des menus</a>
    </footer>
</body>
</html>