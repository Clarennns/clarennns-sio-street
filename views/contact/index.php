
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Contact</title>
    <link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/contact.css"> 
</head>
<body>

    <!-- Bandeau de navigation -->
    <header>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?controller=menu&action=index">Menus</a>
            <a href="index.php?controller=plat&action=index">Plats</a>
            <a href="index.php?controller=restaurant&action=index">Restaurants</a>
            <a href="index.php?controller=contact&action=index">Contact</a>
            <?php if (isset($_SESSION['user_id'])): ?>
              <!--  <a href="index.php?controller=user&action=index">Mon compte</a> -->
                <a href="index.php?controller=user&action=logout">Déconnexion</a>
            <?php else: ?>
                <a href="index.php?controller=user&action=login">Connexion</a>
                <a href="index.php?controller=user&action=register">Inscription</a>
            <?php endif; ?>
        </nav>
    </header>

    <!-- Formulaire de contact -->
    <main>
        <h2>Contactez-nous</h2>
        <form method="post" action="index.php?controller=contact&action=send">
            <div>
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div>
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="numero">Numéro de téléphone :</label>
                <input type="tel" id="numero" name="numero" maxlength="20" placeholder="Ex : 0612345678">
            </div>
            <div>
                <label for="message">Message :</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div>
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Sio Street</p>
    </footer>
    
</body>
</html>