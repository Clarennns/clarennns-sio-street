<?php
require_once 'User.php';

class Restaurateur extends User {
    private $nomRestaurant;

    public function __construct($id, $nom, $prenom, $email, $password, $nomRestaurant) {
        parent::__construct($id, $nom, $prenom, $email, $password);
        $this->nomRestaurant = $nomRestaurant;
    }

    // Getter et Setter pour le nom du restaurant
    public function getNomRestaurant() {
        return $this->nomRestaurant;
    }

    public function setNomRestaurant($nomRestaurant) {
        $this->nomRestaurant = $nomRestaurant;
    }
}
?>