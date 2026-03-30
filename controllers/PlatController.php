<?php
require_once 'models/Plat.php';

class PlatController {
    private function requireAdmin() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $role = strtolower(trim((string)($_SESSION['user_role'] ?? '')));
        if (!isset($_SESSION['user_id']) || $role !== 'admin') {
            echo "Accès refusé : fonctionnalité réservée aux administrateurs.";
            exit;
        }
    }

    public function index() {
        $plats = Plat::getAll();
        require 'views/plat/index.php';
    }

    public function show($id) {
        $plat = Plat::getById((int)$id);
        if (!$plat) {
            header('Location: index.php?controller=plat&action=index');
            exit;
        }

        require 'views/plat/show.php';
    }

    public function create() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prix = $_POST['prix'] ?? null;

            if ($nom !== '' && is_numeric($prix)) {
                Plat::create($nom, (float)$prix);
                header('Location: index.php?controller=plat&action=index');
                exit;
            }
        }

        require 'views/plat/create.php';
    }

    public function update($id) {
        $this->requireAdmin();

        $plat = Plat::getById((int)$id);
        if (!$plat) {
            header('Location: index.php?controller=plat&action=index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prix = $_POST['prix'] ?? null;

            if ($nom !== '' && is_numeric($prix)) {
                Plat::update((int)$id, $nom, (float)$prix);
                header('Location: index.php?controller=plat&action=index');
                exit;
            }
        }

        require 'views/plat/update.php';
    }

    public function delete($id) {
        $this->requireAdmin();

        Plat::delete((int)$id);
        header('Location: index.php?controller=plat&action=index');
        exit;
    }
}
?>
