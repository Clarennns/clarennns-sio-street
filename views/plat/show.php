<!-- views/plat/show.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du plat</title>
</head>
<body>
    <h1>Détails du plat</h1>

    <p><strong>Nom :</strong> <?= htmlspecialchars($plat->getNom()); ?></p>
    <p><strong>Prix :</strong> <?= number_format($plat->getPrix(), 2, ',', ' ') ?> €</p>

    <?php if ($plat->getImage()): ?>
        <p><img src="images/<?= htmlspecialchars($plat->getImage()); ?>" alt="Image du plat" width="300"></p>
    <?php else: ?>
        <p><em>Aucune image disponible</em></p>
    <?php endif; ?>

    <p><a href="index.php?controller=plat&action=index">Retour à la liste des plats</a></p>
</body>
</html>