<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($menu->getNom()); ?></title>
    <link rel="stylesheet" href="css/styles.css"> 
</head>
<body>
    <header>
        <h1>Menu : <?php echo htmlspecialchars($menu->getNom()); ?></h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?controller=menu&action=index">Menus</a>
            <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'restaurateur'): ?>
                <a href="index.php?controller=menu&action=update&id=<?php echo $menu->getId(); ?>">Modifier ce menu</a>
            <?php endif; ?>
        </nav>
    </header>

    <section>
        <h2>Les plats du menu</h2>
        <div class="plats">
            <?php foreach ($plats as $plat): ?>
                <div class="plat">
                    <h3><?php echo htmlspecialchars($plat->getNom()); ?></h3>
                    <p>Prix : <?php echo number_format($plat->getPrix(), 2, ',', ' '); ?> €</p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</body>
</html>