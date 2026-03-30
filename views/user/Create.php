<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création d'un utilisateur</title>
</head>
<body>
    <h2>Créer un nouvel utilisateur</h2>
    <form method="POST">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" required><br>

        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required><br>

        <label for="role">Rôle:</label>
        <select name="role">
            <option value="client">Client</option>
            <option value="restaurateur">Restaurateur</option>
            <option value="vendeur">Vendeur</option>
        </select><br>

        <button type="submit">Créer l'utilisateur</button>
    </form>
</body>
</html>