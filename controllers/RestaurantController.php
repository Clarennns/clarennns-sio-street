<?php
require_once 'models/Restaurant.php';

class RestaurantController {

    // Afficher tous les restaurants
    public function index() {
        $restaurants = Restaurant::getAll();
        require 'views/restaurant/index.php';
    }

    // Afficher un restaurant par ID (détails)
    public function show($id) {
        $restaurant = Restaurant::getById($id);
        if ($restaurant) {
            require 'views/restaurant/show.php';
        } else {
            header('Location: index.php?controller=restaurant&action=index');
            exit;
        }
    }

    // Créer un restaurant
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $ville = $_POST['ville'];
            $adresse = $_POST['adresse'];
            $codePostal = $_POST['codePostal'];

            Restaurant::create($nom, $ville, $adresse, $codePostal);
            header('Location: index.php?controller=restaurant&action=index');
            exit;
        }
        require 'views/restaurant/create.php';
    }

    // Modifier un restaurant
    public function update($id) {
        $restaurant = Restaurant::getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'];
            $ville = $_POST['ville'];
            $adresse = $_POST['adresse'];
            $codePostal = $_POST['codePostal'];

            Restaurant::update($id, $nom, $ville, $adresse, $codePostal);
            header('Location: index.php?controller=restaurant&action=index');
            exit;
        }

        if ($restaurant) {
            require 'views/restaurant/update.php';
        } else {
            header('Location: index.php?controller=restaurant&action=index');
            exit;
        }
    }

    // Supprimer un restaurant
    public function delete($id) {
        $restaurant = Restaurant::getById($id);
        if ($restaurant) {
            Restaurant::delete($id);
        }
        header('Location: index.php?controller=restaurant&action=index');
        exit;
    }
}
?>