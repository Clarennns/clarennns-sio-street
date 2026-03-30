<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un menu</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/style.css">
</head>
<body>
    <?php $activePage = 'menu'; require __DIR__ . '/../partials/header.php'; ?>
    <h1>Créer un menu</h1>

    <section>
        <h2>Nouveau menu</h2>

        <?php if (isset($error)): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form action="index.php?controller=menu&action=create" method="POST">
            <label for="nom">Nom du menu :</label>
            <input type="text" name="nom" id="nom" required><br><br>

            <label for="prix">Prix (€) :</label>
            <input type="number" name="prix" id="prix" step="0.01" min="0" required><br><br>

            <label for="restaurant_id">Restaurant :</label>
            <select name="restaurant_id" id="restaurant_id" required>
                <option value="">-- Sélectionner --</option>
                <?php foreach ($restaurants as $restaurant): ?>
                    <option value="<?php echo $restaurant->getId(); ?>">
                        <?php echo htmlspecialchars($restaurant->getNom()); ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <button type="submit">Créer</button>
        </form>
    </section>
</body>
</html>
