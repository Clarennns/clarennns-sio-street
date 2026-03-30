<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le Menu</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/style.css">
</head>
<body>
    <?php $activePage = 'menu'; require __DIR__ . '/../partials/header.php'; ?>
    <h1>Modifier le Menu : <?php echo htmlspecialchars($menu->getNom()); ?></h1>

    <section>
        <h2>Formulaire de Modification</h2>
        <form action="index.php?controller=menu&action=update&id=<?php echo $menu->getId(); ?>" method="POST">
            <div>
                <label for="nom">Nom du Menu :</label>
                <input type="text" name="nom" id="nom" value="<?php echo htmlspecialchars($menu->getNom()); ?>" required>
            </div>

            <div>
                <label for="prix">Prix :</label>
                <input type="number" name="prix" id="prix" step="0.01" min="0" value="<?php echo htmlspecialchars($menu->getPrix()); ?>" required>
            </div>

            <div>
                <label for="restaurant_id">Restaurant :</label>
                <select name="restaurant_id" id="restaurant_id" required>
                    <?php foreach ($restaurants as $restaurant): ?>
                        <option value="<?php echo $restaurant->getId(); ?>" <?php echo ((int)$menu->getRestaurantId() === (int)$restaurant->getId()) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($restaurant->getNom()); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
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