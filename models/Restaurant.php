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
        $nextIdStmt = $db->query("SELECT COALESCE(MAX(IDRestaurant), 0) + 1 AS NextId FROM Restaurant");
        $nextId = (int)$nextIdStmt->fetch(PDO::FETCH_ASSOC)['NextId'];

        $stmt = $db->prepare("INSERT INTO Restaurant (IDRestaurant, NomRestaurant, VilleRestaurant, AdresseRestaurant, CodePostaleRestaurant) VALUES (:id, :nom, :ville, :adresse, :codePostal)");
        $stmt->bindParam(':id', $nextId, PDO::PARAM_INT);
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
        $id = (int)$id;

        try {
            $db->beginTransaction();

            // Supprimer les receptions associees aux restaurateurs du restaurant.
            $stmt = $db->prepare("DELETE rc FROM `Réception_de_commande` rc INNER JOIN Restaurateur r ON rc.Id = r.Id WHERE r.IDRestaurant = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les restaurateurs rattaches au restaurant.
            $stmt = $db->prepare("DELETE FROM Restaurateur WHERE IDRestaurant = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les liaisons des menus rattaches au restaurant.
            $stmt = $db->prepare("DELETE cdm FROM Commande_du_Menu cdm INNER JOIN Menu m ON cdm.IDMenu = m.IDMenu WHERE m.IDRestaurant = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $db->prepare("DELETE cpm FROM Choix_du_plat_dans_le_menu cpm INNER JOIN Menu m ON cpm.IDMenu = m.IDMenu WHERE m.IDRestaurant = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer les menus du restaurant.
            $stmt = $db->prepare("DELETE FROM Menu WHERE IDRestaurant = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Supprimer finalement le restaurant.
            $stmt = $db->prepare("DELETE FROM Restaurant WHERE IDRestaurant = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $deleted = $stmt->execute();

            $db->commit();
            return $deleted;
        } catch (PDOException $e) {
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            throw $e;
        }
    }
}
?>