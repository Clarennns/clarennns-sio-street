<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une commande</title>
</head>
<body>
    <h1>Formulaire de commande</h1>
    <form action="index.php?controller=commande&action=create" method="POST">
        <label for="client_id">Client ID :</label>
        <input type="text" name="client_id" id="client_id" required><br><br>

        <label for="plat_id">Plat ID :</label>
        <input type="text" name="plat_id" id="plat_id" required><br><br>

        <button type="submit">Créer la commande</button>
    </form>
</body>
</html>