<?php
require_once 'models/Menu.php';
require_once 'models/Plat.php';

class MenuController {
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
    
    // Afficher tous les menus
    public function index() {
        // Récupérer tous les menus depuis la base de données
        $menus = Menu::getAll();
        
        // Charger la vue d'affichage des menus
        require 'views/menu/index.php';
    }
    
    // Afficher un menu spécifique avec ses plats
    public function show($id) {
        // Récupérer le menu par son ID
        $menu = Menu::getById($id);
        
        if (!$menu) {
            // Si le menu n'existe pas, rediriger vers l'accueil ou afficher un message d'erreur
            header("Location: index.php");
            exit;
        }
        
        // Récupérer les plats associés à ce menu
        $plats = Plat::getByMenuId($id);
        
        // Charger la vue d'affichage du menu et de ses plats
        require 'views/menu/show.php';
    }

    public function create() {
        $this->requireAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prix = $_POST['prix'] ?? null;
            $restaurantId = $_POST['restaurant_id'] ?? null;

            if ($nom !== '' && is_numeric($prix) && (int)$restaurantId > 0) {
                Menu::create($nom, (float)$prix, (int)$restaurantId);
                header('Location: index.php?controller=menu&action=index');
                exit;
            }

            $error = "Veuillez saisir un nom, un prix valide et un restaurant valide.";
        }

        require_once 'models/Restaurant.php';
        $restaurants = Restaurant::getAll();
        require 'views/menu/create.php';
    }

    public function update($id) {
        $this->requireAdmin();

        $menu = Menu::getById($id);
        if (!$menu) {
            header('Location: index.php?controller=menu&action=index');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prix = $_POST['prix'] ?? null;
            $restaurantId = $_POST['restaurant_id'] ?? null;

            if ($nom !== '' && is_numeric($prix) && (int)$restaurantId > 0) {
                Menu::update((int)$id, $nom, (float)$prix, (int)$restaurantId);
                header('Location: index.php?controller=menu&action=show&id=' . (int)$id);
                exit;
            }

            $error = "Veuillez saisir un nom, un prix valide et un restaurant valide.";
        }

        require_once 'models/Restaurant.php';
        $restaurants = Restaurant::getAll();
        require 'views/menu/update.php';
    }

    // Alias de compatibilité
    public function edit($id) {
        $this->update($id);
    }

    public function delete($id) {
        $this->requireAdmin();

        Menu::delete((int)$id);

        header('Location: index.php?controller=menu&action=index');
        exit;
    }
}
?>