<?php
require_once 'models/Menu.php';
require_once 'models/Plat.php';

class PanierController {
    private function ensureSessionStarted() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function requireClient() {
        $this->ensureSessionStarted();
        $role = strtolower(trim((string)($_SESSION['user_role'] ?? '')));

        if (!isset($_SESSION['user_id']) || $role !== 'client') {
            header('Location: index.php?controller=user&action=login');
            exit;
        }
    }

    private function getCart() {
        $this->ensureSessionStarted();

        if (!isset($_SESSION['panier']) || !is_array($_SESSION['panier'])) {
            $_SESSION['panier'] = [];
        }

        return $_SESSION['panier'];
    }

    private function saveCart($cart) {
        $_SESSION['panier'] = $cart;
    }

    private function setFlash($type, $message) {
        $_SESSION['panier_flash_' . $type] = $message;
    }

    private function pullFlash($type) {
        $key = 'panier_flash_' . $type;
        if (!isset($_SESSION[$key])) {
            return null;
        }

        $message = $_SESSION[$key];
        unset($_SESSION[$key]);
        return $message;
    }

    public function index() {
        $this->requireClient();

        $cart = $this->getCart();
        $items = array_values($cart);
        $total = 0.0;

        foreach ($items as $item) {
            $total += ((float)$item['prix']) * ((int)$item['quantite']);
        }

        $successMessage = $this->pullFlash('success');
        $errorMessage = $this->pullFlash('error');

        require 'views/panier/index.php';
    }

    public function add() {
        $this->requireClient();

        $type = strtolower(trim((string)($_POST['item_type'] ?? $_GET['item_type'] ?? '')));
        $itemId = (int)($_POST['item_id'] ?? $_GET['item_id'] ?? 0);
        $quantity = (int)($_POST['quantite'] ?? $_GET['quantite'] ?? 1);

        if (!in_array($type, ['menu', 'plat'], true) || $itemId <= 0) {
            $this->setFlash('error', 'Article invalide.');
            header('Location: index.php?controller=panier&action=index');
            exit;
        }

        $entity = $type === 'menu' ? Menu::getById($itemId) : Plat::getById($itemId);
        if (!$entity) {
            $this->setFlash('error', 'Article introuvable.');
            header('Location: index.php?controller=panier&action=index');
            exit;
        }

        $quantity = max(1, $quantity);
        $cart = $this->getCart();
        $itemKey = $type . '_' . $itemId;

        if (!isset($cart[$itemKey])) {
            $cart[$itemKey] = [
                'key' => $itemKey,
                'type' => $type,
                'id' => $itemId,
                'nom' => $entity->getNom(),
                'prix' => (float)$entity->getPrix(),
                'image' => method_exists($entity, 'getImage') ? $entity->getImage() : null,
                'quantite' => 0,
            ];
        }

        $cart[$itemKey]['quantite'] += $quantity;
        $this->saveCart($cart);

        $this->setFlash('success', 'Article ajouté au panier.');
        header('Location: index.php?controller=panier&action=index');
        exit;
    }

    public function update() {
        $this->requireClient();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: index.php?controller=panier&action=index');
            exit;
        }

        $itemKey = (string)($_POST['item_key'] ?? '');
        $quantity = (int)($_POST['quantite'] ?? 1);

        $cart = $this->getCart();
        if (!isset($cart[$itemKey])) {
            $this->setFlash('error', 'Article introuvable dans le panier.');
            header('Location: index.php?controller=panier&action=index');
            exit;
        }

        if ($quantity <= 0) {
            unset($cart[$itemKey]);
            $this->setFlash('success', 'Article retiré du panier.');
        } else {
            $cart[$itemKey]['quantite'] = $quantity;
            $this->setFlash('success', 'Quantité mise à jour.');
        }

        $this->saveCart($cart);
        header('Location: index.php?controller=panier&action=index');
        exit;
    }

    public function remove() {
        $this->requireClient();

        $itemKey = (string)($_GET['item_key'] ?? '');
        $cart = $this->getCart();

        if (isset($cart[$itemKey])) {
            unset($cart[$itemKey]);
            $this->saveCart($cart);
            $this->setFlash('success', 'Article retiré du panier.');
        }

        header('Location: index.php?controller=panier&action=index');
        exit;
    }

    public function clear() {
        $this->requireClient();

        $_SESSION['panier'] = [];
        $this->setFlash('success', 'Panier vidé.');

        header('Location: index.php?controller=panier&action=index');
        exit;
    }
}
