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

    // Récupérer tous les restaurants
    public static function getAll() {
        $db = Database::getConnection();
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

    // Récupérer un restaurant par ID
    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM Restaurant WHERE IDRestaurant = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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

    // Créer un restaurant (ajout de la vérification de rôle)
    public static function create($nom, $ville, $adresse, $codePostal) {
        // Vérifier si l'utilisateur est un restaurateur
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'restaurateur') {
            $db = Database::getConnection();
            $stmt = $db->prepare("INSERT INTO Restaurant (NomRestaurant, VilleRestaurant, AdresseRestaurant, CodePostaleRestaurant) VALUES (:nom, :ville, :adresse, :codePostal)");
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':codePostal', $codePostal);
            $stmt->execute();
        } else {
            // Utilisateur non autorisé
            throw new Exception('Vous devez être un restaurateur pour ajouter un restaurant.');
        }
    }

    // Mettre à jour un restaurant (ajout de la vérification de rôle)
    public static function update($id, $nom, $ville, $adresse, $codePostal) {
        // Vérifier si l'utilisateur est un restaurateur
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'restaurateur') {
            $db = Database::getConnection();
            $stmt = $db->prepare("UPDATE Restaurant SET NomRestaurant = :nom, VilleRestaurant = :ville, AdresseRestaurant = :adresse, CodePostaleRestaurant = :codePostal WHERE IDRestaurant = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':ville', $ville);
            $stmt->bindParam(':adresse', $adresse);
            $stmt->bindParam(':codePostal', $codePostal);
            $stmt->execute();
        } else {
            // Utilisateur non autorisé
            throw new Exception('Vous devez être un restaurateur pour mettre à jour un restaurant.');
        }
    }

    // Supprimer un restaurant (ajout de la vérification de rôle)
    public static function delete($id) {
        // Vérifier si l'utilisateur est un restaurateur
        if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'restaurateur') {
            $db = Database::getConnection();
            $stmt = $db->prepare("DELETE FROM Restaurant WHERE IDRestaurant = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // Utilisateur non autorisé
            throw new Exception('Vous devez être un restaurateur pour supprimer un restaurant.');
        }
    }
}
?>