<?php
require_once 'models/Restaurant.php';
require_once 'models/Menu.php';

class RestaurantController {
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

    // Afficher tous les restaurants
    public function index() {
        // Récupérer tous les restaurants depuis la base de données
        $restaurants = Restaurant::getAll();
        
        // Charger la vue d'affichage des restaurants
        require 'views/restaurant/index.php';
    }

    // Illustrer l'association 1,N : un restaurant possède plusieurs menus
    public function show($id) {
        $restaurant = Restaurant::getById($id);

        if (!$restaurant) {
            header('Location: index.php?controller=restaurant&action=index');
            exit;
        }

        $menus = Menu::getByRestaurantId($id);
        require 'views/restaurant/show.php';
    }

    public function create() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $ville = trim($_POST['ville'] ?? '');
            $adresse = trim($_POST['adresse'] ?? '');
            $codePostal = trim($_POST['codePostal'] ?? '');

            if ($nom !== '' && $ville !== '' && $adresse !== '' && $codePostal !== '') {
                Restaurant::create($nom, $ville, $adresse, $codePostal);
                header('Location: index.php?controller=restaurant&action=index');
                exit;
            }
        }

        require 'views/restaurant/create.php';
    }

    public function update($id) {
        $this->requireAdmin();

        $restaurant = Restaurant::getById((int)$id);
        if (!$restaurant) {
            header('Location: index.php?controller=restaurant&action=index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $ville = trim($_POST['ville'] ?? '');
            $adresse = trim($_POST['adresse'] ?? '');
            $codePostal = trim($_POST['codePostal'] ?? '');

            if ($nom !== '' && $ville !== '' && $adresse !== '' && $codePostal !== '') {
                Restaurant::update((int)$id, $nom, $ville, $adresse, $codePostal);
                header('Location: index.php?controller=restaurant&action=index');
                exit;
            }
        }

        require 'views/restaurant/update.php';
    }

    public function delete($id) {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Restaurant::delete((int)$id);
        }

        header('Location: index.php?controller=restaurant&action=index');
        exit;
    }
}
?>