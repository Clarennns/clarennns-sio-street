<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Plat</title>
</head>
<body>
    <h1>Ajouter un Plat</h1>
    <form action="index.php?controller=plat&action=create&menuId=<?= htmlspecialchars($_GET['menuId'] ?? '') ?>" method="POST" enctype="multipart/form-data">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" required><br><br>

        <label for="prix">Prix :</label>
        <input type="text" name="prix" required><br><br>

        <label for="image">Image :</label>
        <input type="file" name="image"><br><br>

        <button type="submit">Ajouter</button>
    </form>
    <a href="index.php?controller=plat&action=index&menuId=<?= htmlspecialchars($_GET['menuId'] ?? '') ?>">Retour à la liste des plats</a>
</body>
</html>
