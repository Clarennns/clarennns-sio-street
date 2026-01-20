<?php
require_once 'models/Restaurant.php';  // Assurer que le modèle Restaurant est bien inclus

class HomeController {
    // Action d'affichage de la page d'accueil
    public function index() {
        // Récupérer tous les restaurants
        $restaurants = Restaurant::getAll();

        // Inclure la vue pour l'accueil
        require_once 'views/home/index.php';  // Crée une vue spécifique pour l'accueil
    }
}
?>