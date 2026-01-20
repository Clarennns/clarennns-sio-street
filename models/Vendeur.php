<?php
require_once 'User.php';

class Vendeur extends User {
    private $zoneDeVente;

    public function __construct($id, $nom, $prenom, $email, $password, $zoneDeVente) {
        parent::__construct($id, $nom, $prenom, $email, $password);
        $this->zoneDeVente = $zoneDeVente;
    }

    // Getter et Setter pour la zone de vente
    public function getZoneDeVente() {
        return $this->zoneDeVente;
    }

    public function setZoneDeVente($zoneDeVente) {
        $this->zoneDeVente = $zoneDeVente;
    }
}
?>