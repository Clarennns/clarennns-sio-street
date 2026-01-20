<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <header>
    <h1>Inscription</h1>
    <nav>
      <a href="index.php">Accueil</a>
      <a href="index.php?controller=user&action=login">Connexion</a>
    </nav>
  </header>

  <section>
    <h2>Formulaire d'inscription</h2>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
      <?php 
        // Récupération des champs
        $nom        = $_POST['nom'] ?? '';
        $prenom     = $_POST['prenom'] ?? '';
        $email      = $_POST['email'] ?? '';
        $motdepasse = $_POST['motdepasse'] ?? '';

        if ($nom && $prenom && $email && $motdepasse) {
          $existingUser = User::getByEmail($email);
          if (!$existingUser) {
            // Rôle forcé à "client"
            $user = new User(null, $nom, $prenom, $email, $motdepasse, 'client');
            if ($user->save()) {
              header('Location: index.php?controller=user&action=login');
              exit();
            } else {
              echo "<p style='color:red;'>Erreur lors de la création de l'utilisateur.</p>";
            }
          } else {
            echo "<p style='color:red;'>Cet email existe déjà.</p>";
          }
        } else {
          echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
        }
      ?>
    <?php endif; ?>

    <form action="index.php?controller=user&action=register" method="POST">
      <label for="nom">Nom :</label>
      <input type="text" name="nom" id="nom" required><br><br>

      <label for="prenom">Prénom :</label>
      <input type="text" name="prenom" id="prenom" required><br><br>

      <label for="email">Email :</label>
      <input type="email" name="email" id="email" required><br><br>

      <label for="motdepasse">Mot de passe :</label>
      <input type="password" name="motdepasse" id="motdepasse" required><br><br>

      <button type="submit">S'inscrire</button>
    </form>
  </section>
</body>
</html>