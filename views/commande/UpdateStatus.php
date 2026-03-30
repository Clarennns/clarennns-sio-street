<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier le statut</title>
</head>
<body>
    <h1>Modifier le statut de la commande</h1>
    <form action="index.php?controller=commande&action=updateStatus&id=<?= $commande->getId(); ?>" method="POST">
        <label for="status">Nouveau statut :</label>
        <select name="status" id="status" required>
            <option value="en attente">En attente</option>
            <option value="en préparation">En préparation</option>
            <option value="prêt à livrer">Prêt à livrer</option>
            <option value="livré">Livré</option>
        </select><br><br>

        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>