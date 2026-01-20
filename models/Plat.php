<?php
require_once 'config/database.php';

class Plat {
    private $id;
    private $nom;
    private $prix;
    private $image;

    public function __construct($id, $nom, $prix, $image) {
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

    // Méthode pour récupérer tous les plats
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT IDPlat, NomPlat, PrixPlat, ImagePlat FROM Plat");

        $plats = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $plats[] = new Plat($row['IDPlat'], $row['NomPlat'], $row['PrixPlat'], $row['ImagePlat']);
        }

        return $plats;
    }

    // Méthode pour récupérer les plats d'un menu spécifique
    public static function getByMenuId($menuId) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT Plat.IDPlat, Plat.NomPlat, Plat.PrixPlat, Plat.ImagePlat
                             FROM Plat 
                             JOIN Choix_du_plat_dans_le_menu 
                             ON Plat.IDPlat = Choix_du_plat_dans_le_menu.IDPlat
                             WHERE Choix_du_plat_dans_le_menu.IDMenu = :menuId");

        $stmt->bindParam(':menuId', $menuId);
        $stmt->execute();

        $plats = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $plats[] = new Plat($row['IDPlat'], $row['NomPlat'], $row['PrixPlat'], $row['ImagePlat']);
        }

        return $plats;
    }

    // Méthode pour récupérer un plat spécifique par son ID
    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT IDPlat, NomPlat, PrixPlat, ImagePlat FROM Plat WHERE IDPlat = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Plat($row['IDPlat'], $row['NomPlat'], $row['PrixPlat'], $row['ImagePlat']);
        }

        return null;
    }

    // Méthode pour ajouter un plat
    public function save($menuId = null) {
        $db = Database::connect();

        if ($this->id) {
            // Si l'ID est défini, on effectue une mise à jour
            $stmt = $db->prepare("UPDATE Plat SET NomPlat = :nom, PrixPlat = :prix, ImagePlat = :image WHERE IDPlat = :id");
            $stmt->bindParam(':id', $this->id);
        } else {
            // Sinon, on insère un nouveau plat
            $stmt = $db->prepare("INSERT INTO Plat (NomPlat, PrixPlat, ImagePlat) VALUES (:nom, :prix, :image)");
        }

        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prix', $this->prix);
        $stmt->bindParam(':image', $this->image);

        if ($stmt->execute()) {
            if (!$this->id) {
                $this->id = $db->lastInsertId();
            }

            if ($menuId) {
                // Ajouter le plat au menu spécifique
                $stmt = $db->prepare("INSERT INTO Choix_du_plat_dans_le_menu (IDPlat, IDMenu) VALUES (:platId, :menuId)");
                $stmt->bindParam(':platId', $this->id);
                $stmt->bindParam(':menuId', $menuId);
                $stmt->execute();
            }

            return true;
        }

        return false;
    }

    // Méthode pour mettre à jour un plat
    public function update($nom, $prix, $image) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE Plat SET NomPlat = :nom, PrixPlat = :prix, ImagePlat = :image WHERE IDPlat = :id");

        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':id', $this->id);

        return $stmt->execute();
    }

    // Méthode pour supprimer un plat
    public function delete() {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM Plat WHERE IDPlat = :id");
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}
?>