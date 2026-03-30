<?php
require_once 'config/database.php';

class Restaurant {
    private $id;
    private $nom;
    private $ville;
    private $adresse;
    private $codePostal;

    public function __construct($id, $nom, $ville, $adresse, $codePostal) {
        $this->id = $id;
        $this->nom = $nom;
        $this->ville = $ville;
        $this->adresse = $adresse;
        $this->codePostal = $codePostal;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getAdresse() {
        return $this->adresse;
    }

    public function getCodePostal() {
        return $this->codePostal;
    }

    // Méthode pour récupérer tous les restaurants
    public static function getAll() {
        $db = database::getConnection();
        $stmt = $db->query("SELECT * FROM Restaurant");
        $restaurants = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $restaurants[] = new Restaurant(
                $row['IDRestaurant'], 
                $row['NomRestaurant'], 
                $row['VilleRestaurant'], 
                $row['AdresseRestaurant'], 
                $row['CodePostaleRestaurant']
            );
        }
        return $restaurants;
    }

    public static function getById($id) {
        $db = database::getConnection();
        $stmt = $db->prepare("SELECT * FROM Restaurant WHERE IDRestaurant = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new Restaurant(
                $row['IDRestaurant'],
                $row['NomRestaurant'],
                $row['VilleRestaurant'],
                $row['AdresseRestaurant'],
                $row['CodePostaleRestaurant']
            );
        }

        return null;
    }

    public static function create($nom, $ville, $adresse, $codePostal) {
        $db = database::getConnection();
        $stmt = $db->prepare("INSERT INTO Restaurant (NomRestaurant, VilleRestaurant, AdresseRestaurant, CodePostaleRestaurant) VALUES (:nom, :ville, :adresse, :codePostal)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':codePostal', $codePostal);
        return $stmt->execute();
    }

    public static function update($id, $nom, $ville, $adresse, $codePostal) {
        $db = database::getConnection();
        $stmt = $db->prepare("UPDATE Restaurant SET NomRestaurant = :nom, VilleRestaurant = :ville, AdresseRestaurant = :adresse, CodePostaleRestaurant = :codePostal WHERE IDRestaurant = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':ville', $ville);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':codePostal', $codePostal);
        return $stmt->execute();
    }

    public static function delete($id) {
        $db = database::getConnection();
        $stmt = $db->prepare("DELETE FROM Restaurant WHERE IDRestaurant = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>