<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du plat</title>
</head>
<body>
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $role = strtolower(trim((string)($_SESSION['user_role'] ?? '')));
        $isAdmin = isset($_SESSION['user_id']) && $role === 'admin';
    ?>
    <h1>Détails du plat</h1>

    <p>
        <a href="index.php">Accueil</a> |
        <a href="index.php?controller=plat&action=index">Plats</a> |
        <?php if (isset($_SESSION['user_id'])): ?>
            <strong>Connecté<?php if ($role !== ''): ?> (<?php echo htmlspecialchars($role); ?>)<?php endif; ?></strong>
            |
            <a href="index.php?controller=user&action=logout">Déconnexion</a>
        <?php else: ?>
            <a href="index.php?controller=user&action=login">Connexion</a>
        <?php endif; ?>
    </p>

    <p><strong>Nom :</strong> <?= htmlspecialchars($plat->getNom()); ?></p>
    <p><strong>Prix :</strong> <?= number_format($plat->getPrix(), 2, ',', ' ') ?> €</p>
    <p><strong>Description :</strong> <?= htmlspecialchars($plat->getDescription()); ?></p>
    <?php if ($plat->getImage()): ?>
        <p><img src="<?= htmlspecialchars($plat->getImage()); ?>" alt="Image du plat" width="300"></p>
    <?php else: ?>
        <p><em>Aucune image disponible</em></p>
    <?php endif; ?>

    <p>
        <?php if ($isAdmin): ?>
            <a href="index.php?controller=plat&action=update&id=<?php echo (int)$plat->getId(); ?>">Modifier</a>
            |
            <a href="index.php?controller=plat&action=delete&id=<?php echo (int)$plat->getId(); ?>" onclick="return confirm('Supprimer ce plat ?');">Supprimer</a>
            |
        <?php endif; ?>
        <a href="index.php?controller=plat&action=index">Retour à la liste des plats</a>
    </p>
</body>
</html>
