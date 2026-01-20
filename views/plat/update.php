<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Plat</title>
</head>
<body>
    <h1>Modifier un Plat</h1>
    <form action="index.php?controller=plat&action=update&id=<?= $plat->getId(); ?>" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($plat->getNom()); ?>" required><br><br>

        <label for="prix">Prix :</label>
        <input type="text" name="prix" value="<?= htmlspecialchars($plat->getPrix()); ?>" required><br><br>

        <label for="image">Image :</label>
        <input type="file" name="image"><br><br>

        <button type="submit">Mettre à jour</button>
    </form>

    <a href="index.php?controller=plat&action=index&menuId=<?= $_GET['menuId']; ?>">Retour à la liste des plats</a>
</body>
</html>