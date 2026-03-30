<?php
require_once 'User.php';

class Client extends User {
    private $adresseLivraison;

    public function __construct($id, $nom, $prenom, $email, $password, $adresseLivraison) {
        parent::__construct($id, $nom, $prenom, $email, $password);
        $this->adresseLivraison = $adresseLivraison;
    }

    // Getter et Setter pour l'adresse de livraison
    public function getAdresseLivraison() {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison($adresseLivraison) {
        $this->adresseLivraison = $adresseLivraison;
    }
}
?>