<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nos Plats</title>
	<link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/plat.css">
	<style>
		html, body { margin: 0; padding: 0; }
		header { margin: 0; }
		header nav { display: flex; align-items: center; gap: 10px; }
		.logout-link { margin-left: 10px; }
		.account-link {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 40px;
			height: 40px;
			background: #ffffff;
			border-radius: 8px;
			border: 1px solid rgba(0, 0, 0, 0.15);
			text-decoration: none;
		}
		.account-link svg { width: 26px; height: 26px; fill: #000; }
		.auth-state { margin-left: auto; font-weight: 700; color: #0f2f5a; }
	</style>
</head>
<body>
	<?php
		if (session_status() !== PHP_SESSION_ACTIVE) { session_start(); }
		$role = strtolower(trim((string)($_SESSION['user_role'] ?? '')));
		$isAdmin = isset($_SESSION['user_id']) && $role === 'admin';
		$isClient = isset($_SESSION['user_id']) && $role === 'client';
		$isLoggedIn = isset($_SESSION['user_id']);
	?>
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

	<main>
		<h1>Nos Plats</h1>
		<div class="plats-container">
			<?php foreach ($plats as $plat): ?>
				<div class="plat-card">
					<?php
						$platImage = $plat->getImage();
						$fallbackImage = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="440" height="300" viewBox="0 0 440 300"><rect width="100%" height="100%" fill="#f2f2f2"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-size="22" fill="#9a9a9a">Image non disponible</text></svg>');
					?>
					<img class="plat-image" src="<?php echo htmlspecialchars($platImage ?: $fallbackImage); ?>" alt="<?php echo htmlspecialchars($plat->getNom()); ?>">
					<h3><?php echo htmlspecialchars($plat->getNom()); ?></h3>
					<p><?php echo number_format($plat->getPrix(), 2, ',', ' '); ?> €</p>
					<p><?php echo htmlspecialchars($plat->getDescription()); ?></p>

					<div class="actions">
						<a class="btn" href="index.php?controller=plat&action=show&id=<?php echo (int)$plat->getId(); ?>">Voir</a>
						<?php if ($isAdmin): ?>
							<a class="btn" href="index.php?controller=plat&action=update&id=<?php echo (int)$plat->getId(); ?>">Modifier</a>
							<a class="btn delete" href="index.php?controller=plat&action=delete&id=<?php echo (int)$plat->getId(); ?>" onclick="return confirm('Supprimer ce plat ?');">Supprimer</a>
						<?php elseif ($isLoggedIn && $isClient): ?>
							<form action="index.php?controller=panier&action=add" method="POST" style="display:inline; margin:0;">
								<input type="hidden" name="item_type" value="plat">
								<input type="hidden" name="item_id" value="<?php echo (int)$plat->getId(); ?>">
								<input type="hidden" name="quantite" value="1">
								<button class="btn" type="submit">Commander</button>
							</form>
						<?php elseif (!$isLoggedIn): ?>
							<a class="btn" href="index.php?controller=user&action=login">Commander</a>
						<?php endif; ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>

		<?php if ($isAdmin): ?>
			<div class="btn-container">
				<a class="cta-button" href="index.php?controller=plat&action=create">Ajouter un Plat</a>
			</div>
		<?php endif; ?>
	</main>

	<footer>
		<p>&copy; 2025 Sio Street</p>
	</footer>
</body>
</html>
