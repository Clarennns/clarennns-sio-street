<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commandes</title>
</head>
<body>
    <h1>Liste des Commandes</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Client ID</th>
                <th>Plat ID</th>
                <th>Status</th>
                <th>Date Commande</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $commande): ?>
                <tr>
                    <td><?= $commande->getId(); ?></td>
                    <td><?= $commande->getClientId(); ?></td>
                    <td><?= $commande->getPlatId(); ?></td>
                    <td><?= $commande->getStatus(); ?></td>
                    <td><?= $commande->getDateCommande(); ?></td>
                    <td>
                        <?php if ($_SESSION['user_role'] === 'restaurateur' && $commande->getStatus() === 'en attente'): ?>
                            <a href="index.php?controller=commande&action=updateStatus&id=<?= $commande->getId(); ?>">Marquer comme en préparation</a>
                        <?php endif; ?>
                        <?php if ($_SESSION['user_role'] === 'vendeur' && $commande->getStatus() === 'prêt à livrer'): ?>
                            <a href="index.php?controller=commande&action=updateStatus&id=<?= $commande->getId(); ?>">Marquer comme livrée</a>
                        <?php endif; ?>
                        <a href="index.php?controller=commande&action=delete&id=<?= $commande->getId(); ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="index.php?controller=commande&action=create">Ajouter une commande</a>
</body>
</html>