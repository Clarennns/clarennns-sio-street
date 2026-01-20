<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'utilisateur</title>
</head>
<body>
    <h2>Modifier les informations de l'utilisateur</h2>
    <form method="POST">
        <label for="nom">Nom:</label>
        <input type="text" name="nom" value="<?= $user->getNom() ?>" required><br>

        <label for="prenom">Prénom:</label>
        <input type="text" name="prenom" value="<?= $user->getPrenom() ?>" required><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?= $user->getEmail() ?>" required><br>

        <label for="role">Rôle:</label>
        <select name="role">
            <option value="client" <?= $user->getRole() == 'client' ? 'selected' : '' ?>>Client</option>
            <option value="restaurateur" <?= $user->getRole() == 'restaurateur' ? 'selected' : '' ?>>Restaurateur</option>
            <option value="vendeur" <?= $user->getRole() == 'vendeur' ? 'selected' : '' ?>>Vendeur</option>
        </select><br>

        <button type="submit">Mettre à jour l'utilisateur</button>
    </form>
</body>
</html>
