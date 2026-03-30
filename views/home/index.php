<?php
if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

$role = strtolower(trim((string)($_SESSION['user_role'] ?? '')));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sio Street</title>
	<link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/accueil.css">
	<style>
		html, body { margin: 0; padding: 0; }
		header {
			margin: 0;
			background-color: #e63946;
			color: white;
			padding: 15px 0;
		}
		header nav {
			display: flex;
			justify-content: center;
			align-items: center;
			gap: 20px;
		}
		header nav a {
			text-decoration: none;
			color: white;
			font-weight: bold;
			padding: 10px 20px;
			border-radius: 8px;
			transition: background-color 0.3s ease;
			font-size: 1.2em;
			border: 2px solid transparent;
		}
		header nav a:hover {
			background-color: #457b9d;
			border: 2px solid #e63946;
		}
		.logout-link { margin-left: 10px; }
		header nav .account-link {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 40px;
			height: 40px;
			padding: 0;
			font-size: 0;
			line-height: 0;
			background: #ffffff;
			border-radius: 8px;
			border: 1px solid rgba(0, 0, 0, 0.15);
			text-decoration: none;
		}
		header nav .account-link:hover {
			background: #ffffff;
			border: 1px solid rgba(0, 0, 0, 0.15);
		}
		header nav .account-link svg { display: block; width: 26px; height: 26px; }
		header nav .account-link svg path { fill: #000; }
		.auth-state { margin-left: auto; font-weight: 700; color: #0f2f5a; }
	</style>
</head>
<body>
	<header>
		<nav>
			<a href="index.php">Accueil</a>
			<a href="index.php?controller=menu&action=index">Menus</a>
			<a href="index.php?controller=plat&action=index">Plats</a>
			<a href="index.php?controller=restaurant&action=index">Restaurants</a>
			<a href="index.php?controller=contact&action=index">Contact</a>
			<a href="index.php?controller=panier&action=index">Panier</a>
			<?php if (isset($_SESSION['user_id'])): ?>
				<span class="auth-state">Connecté<?php if ($role !== ''): ?> (<?php echo htmlspecialchars($role); ?>)<?php endif; ?></span>
				<a class="logout-link" href="index.php?controller=user&action=logout">Déconnexion</a>
				<a class="account-link" href="index.php?controller=user&action=profile" title="Mon compte" aria-label="Mon compte">
					<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
						<path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z"></path>
					</svg>
				</a>
			<?php else: ?>
				<a href="index.php?controller=user&action=login">Connexion</a>
				<a href="index.php?controller=user&action=register">Inscription</a>
			<?php endif; ?>
		</nav>
	</header>

	<section class="story">
		<p><strong>Sio Street</strong> est née en 2024, avec l’ouverture de son premier restaurant dans le 14e arrondissement de Paris. Dès le départ, l’objectif était simple : offrir une expérience de poulet unique, rapide et savoureuse. Aujourd’hui, la franchise s’étend à travers la France, avec l’ambition de partager notre passion pour le poulet grillé et frit, tout en maintenant la qualité au cœur de nos recettes.</p>
	</section>

	<section class="hero">
		<div class="hero-content">
			<h1>Bienvenue chez Sio Street</h1>
			<p>Les meilleurs poulets de la ville. Savourez nos recettes uniques.</p>
			<a href="index.php?controller=menu&action=index" class="cta-button">Voir nos Menus</a>
		</div>
	</section>

	<section>
		<h2>Nos Restaurants</h2>
		<div class="restaurants">
			<?php foreach ($restaurants as $restaurant): ?>
				<div class="restaurant">
					<h3><?php echo htmlspecialchars($restaurant->getNom()); ?></h3>
					<p>Ville : <?php echo htmlspecialchars($restaurant->getVille()); ?></p>
					<p>Adresse : <?php echo htmlspecialchars($restaurant->getAdresse()); ?></p>
					<p>Code Postal : <?php echo htmlspecialchars($restaurant->getCodePostal()); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</section>

	<footer>
		<p>&copy; 2025 Sio Street | Tous droits réservés</p>
	</footer>
</body>
</html>
