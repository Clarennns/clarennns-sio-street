<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

$role = strtolower(trim((string)($_SESSION['user_role'] ?? '')));
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Panier</title>
	<link rel="stylesheet" href="/site_restaurant_mvc_v2_correct/css/panier.css">
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

	<main class="panier-page">
		<h1>Mon panier</h1>

		<?php if (!empty($successMessage)): ?>
			<div class="alert alert-success"><?php echo htmlspecialchars($successMessage); ?></div>
		<?php endif; ?>

		<?php if (!empty($errorMessage)): ?>
			<div class="alert alert-error"><?php echo htmlspecialchars($errorMessage); ?></div>
		<?php endif; ?>

		<?php if (!empty($items)): ?>
			<?php foreach ($items as $item): ?>
				<?php
					$fallbackImage = 'data:image/svg+xml;utf8,' . rawurlencode('<svg xmlns="http://www.w3.org/2000/svg" width="160" height="120" viewBox="0 0 160 120"><rect width="100%" height="100%" fill="#f2f2f2"/><text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" font-family="Arial, sans-serif" font-size="14" fill="#9a9a9a">Image</text></svg>');
					$lineTotal = ((float)$item['prix']) * ((int)$item['quantite']);
				?>
				<article class="cart-item">
					<img src="<?php echo htmlspecialchars($item['image'] ?: $fallbackImage); ?>" alt="<?php echo htmlspecialchars($item['nom']); ?>">
					<div class="cart-item-info">
						<h3><?php echo htmlspecialchars($item['nom']); ?></h3>
						<p>Type : <?php echo htmlspecialchars(ucfirst((string)$item['type'])); ?></p>
						<p>Prix unitaire : <?php echo number_format((float)$item['prix'], 2, ',', ' '); ?> €</p>
						<p>Total ligne : <?php echo number_format($lineTotal, 2, ',', ' '); ?> €</p>
						<div class="cart-item-actions">
							<form action="index.php?controller=panier&action=update" method="POST">
								<input type="hidden" name="item_key" value="<?php echo htmlspecialchars($item['key']); ?>">
								<input type="number" name="quantite" min="0" value="<?php echo (int)$item['quantite']; ?>" required>
								<button type="submit">Mettre à jour</button>
							</form>
							<a href="index.php?controller=panier&action=remove&item_key=<?php echo urlencode((string)$item['key']); ?>">Retirer</a>
						</div>
					</div>
				</article>
			<?php endforeach; ?>

			<section class="cart-total">
				<p>Total panier : <strong><?php echo number_format((float)$total, 2, ',', ' '); ?> €</strong></p>
				<a class="btn-danger" href="index.php?controller=panier&action=clear" onclick="return confirm('Vider le panier ?');">Vider le panier</a>
			</section>
		<?php else: ?>
			<p class="empty">Votre panier est vide.</p>
		<?php endif; ?>
	</main>
</body>
</html>
