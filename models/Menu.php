<?php
require_once 'config/Database.php';

class Menu {
    private $id;
    private $nom;
    private $prix;
    private $image;

    public function __construct($id, $nom, $prix, $image = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->image = $image;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getImage() {
        return $this->image;
    }

    // Récupérer tous les menus
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM Menu");
        $menus = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $image = isset($row['ImageMenu']) ? $row['ImageMenu'] : null;
            $menus[] = new Menu($row['IDMenu'], $row['NomMenu'], $row['PrixMenu'], $image);
        }
        return $menus;
    }

    // Récupérer un menu par son ID
    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM Menu WHERE IDMenu = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            $image = isset($row['ImageMenu']) ? $row['ImageMenu'] : null;
            return new Menu($row['IDMenu'], $row['NomMenu'], $row['PrixMenu'], $image);
        }

        return null;
    }

    // Créer un nouveau menu
    public static function create($nom, $prix, $imagePath = null) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO Menu (NomMenu, PrixMenu, ImageMenu) VALUES (:nom, :prix, :image)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':image', $imagePath);
        
        // Vérifie si la requête a bien été exécutée
        if ($stmt->execute()) {
            return true;
        } else {
            // Gestion des erreurs
            print_r($stmt->errorInfo());
            return false;
        }
    }

    // Mettre à jour un menu
    public static function update($id, $nom, $prix, $imagePath = null) {
        $db = Database::connect();
        
        // Vérifie si le menu existe avant de tenter de le mettre à jour
        $menu = self::getById($id);
        if (!$menu) {
            return false; // Si le menu n'existe pas, on ne fait rien
        }

        $stmt = $db->prepare("UPDATE Menu SET NomMenu = :nom, PrixMenu = :prix, ImageMenu = :image WHERE IDMenu = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':image', $imagePath);
        
        // Vérifie si la requête a bien été exécutée
        if ($stmt->execute()) {
            return true;
        } else {
            // Gestion des erreurs
            print_r($stmt->errorInfo());
            return false;
        }
    }

    // Supprimer un menu
    public static function delete($id) {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM Menu WHERE IDMenu = :id");
        $stmt->bindParam(':id', $id);
        
        // Vérifie si la suppression a bien eu lieu
        if ($stmt->execute()) {
            return true;
        } else {
            // Gestion des erreurs
            print_r($stmt->errorInfo());
            return false;
        }
    }
}
?>