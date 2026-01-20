<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion</title>
  <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
  <header>
    <h1>Connexion</h1>
    <nav>
      <a href="index.php">Accueil</a>
      <a href="index.php?controller=user&action=register">Inscription</a>
    </nav>
  </header>

  <section>
    <h2>Formulaire de connexion</h2>

    <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
      <?php
        $email      = $_POST['email'] ?? '';
        $motdepasse = $_POST['motdepasse'] ?? '';

        if ($email && $motdepasse) {
          $user = User::getByEmail($email);
          if ($user && $user->verifyPassword($motdepasse)) {
            session_start();
            $_SESSION['user_id']    = $user->getId();
            $_SESSION['user_email'] = $user->getEmail();
            $_SESSION['user_role']  = $user->getRole();
            header('Location: index.php');
            exit();
          } else {
            echo "<p style='color:red;'>Identifiants incorrects.</p>";
          }
        } else {
          echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
        }
      ?>
    <?php endif; ?>

    <form action="index.php?controller=user&action=login" method="POST">
      <label for="email">Email :</label>
      <input type="email" name="email" id="email" required><br><br>

      <label for="motdepasse">Mot de passe :</label>
      <input type="password" name="motdepasse" id="motdepasse" required><br><br>

      <button type="submit">Se connecter</button>
    </form>
  </section>
</body>
</html>