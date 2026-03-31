<?php
require_once 'config/database.php';

class Menu {
    private $id;
    private $nom;
    private $prix;
    private $restaurantId;
    private $image;
    private $description;
    private static $imageIndex = null;

    public function __construct($id, $nom, $prix, $restaurantId = null, $image = null, $description = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
        $this->restaurantId = $restaurantId;
        $this->image = $image;
        $this->description = $description ?? self::buildDescription($nom, $id);
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

    public function getRestaurantId() {
        return $this->restaurantId;
    }

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    private static function buildDescription($nom, $id) {
        $base = trim((string)$nom);
        if ($base === '') {
            $base = 'ce menu';
        }

        $catalog = [
            'menu midi' => "Une formule equilibree pour le dejeuner, avec entree, plat et dessert dans un format rapide et gourmand.",
            'menu degustation' => "Un parcours en plusieurs services qui met en avant les specialites de la maison et les produits de saison.",
            'menu pizza boisson' => "Une pizza genereuse accompagnee d'une boisson, ideale pour un repas simple, complet et convivial.",
            'menu veggie' => "Une selection vegetarienne fraiche et coloree, avec des preparations riches en gout et en texture."
        ];

        $normalizedBase = self::normalizeImageKey($base);
        foreach ($catalog as $label => $description) {
            if (self::normalizeImageKey($label) === $normalizedBase) {
                return $description;
            }
        }

        $styles = [
            "Un assortiment maison autour de %s, prepare pour offrir un bon equilibre entre gourmandise et fraicheur.",
            "%s met a l'honneur des produits soigneusement selectionnes, avec une touche du chef selon la saison.",
            "Pensé pour les amateurs de saveurs franches, %s propose une experience complete de l'entree au dessert.",
            "%s combine des recettes conviviales et une finition minute pour garder toute l'intensite des gouts.",
            "Ce format %s privilegie des portions harmonieuses et une composition ideale pour un repas complet."
        ];

        $index = abs(crc32(strtolower($base) . '-' . (int)$id)) % count($styles);
        return sprintf($styles[$index], $base);
    }

    private static function normalizeImageKey($value) {
        $value = trim((string)$value);
        if ($value === '') {
            return '';
        }

        if (function_exists('iconv')) {
            $converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
            if ($converted !== false) {
                $value = $converted;
            }
        }

        $value = strtolower($value);
        $value = preg_replace('/[^a-z0-9]+/', '', $value);
        return $value;
    }

    private static function getImageIndex($imagesDir) {
        if (self::$imageIndex !== null) {
            return self::$imageIndex;
        }

        self::$imageIndex = [];
        foreach (glob($imagesDir . '*.{png,jpg,jpeg,webp}', GLOB_BRACE) as $filePath) {
            $filename = basename($filePath);
            $stem = pathinfo($filename, PATHINFO_FILENAME);
            $key = self::normalizeImageKey($stem);
            if ($key !== '' && !isset(self::$imageIndex[$key])) {
                self::$imageIndex[$key] = $filename;
            }
        }

        return self::$imageIndex;
    }

    private static function resolveImageByName($nom) {
        $imagesDir = __DIR__ . '/../images/';
        if (!is_dir($imagesDir)) {
            return null;
        }

        $base = trim((string)$nom);
        if ($base === '') {
            return null;
        }

        $candidates = [];
        $candidates[] = $base;
        $candidates[] = str_replace(' ', '_', $base);
        $candidates[] = str_replace(' ', '', $base);
        $candidates[] = str_replace('-', '_', $base);

        foreach ($candidates as $name) {
            foreach (['png', 'jpg', 'jpeg', 'webp'] as $ext) {
                $file = $name . '.' . $ext;
                if (file_exists($imagesDir . $file)) {
                    return '/site_restaurant_mvc_v2_correct/images/' . rawurlencode($file);
                }
            }
        }

        $normalizedName = self::normalizeImageKey($base);
        if ($normalizedName !== '') {
            $imageIndex = self::getImageIndex($imagesDir);
            if (isset($imageIndex[$normalizedName])) {
                return '/site_restaurant_mvc_v2_correct/images/' . rawurlencode($imageIndex[$normalizedName]);
            }
        }

        return null;
    }

    // Méthode pour récupérer tous les menus
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM Menu");
        $menus = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $menus[] = new Menu(
                $row['IDMenu'],
                $row['NomMenu'],
                $row['PrixMenu'],
                $row['IDRestaurant'] ?? null,
                self::resolveImageByName($row['NomMenu']),
                self::buildDescription($row['NomMenu'], $row['IDMenu'])
            );
        }
        return $menus;
    }

    // Méthode pour récupérer un menu par son ID
    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM Menu WHERE IDMenu = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($row) {
            return new Menu(
                $row['IDMenu'],
                $row['NomMenu'],
                $row['PrixMenu'],
                $row['IDRestaurant'] ?? null,
                self::resolveImageByName($row['NomMenu']),
                self::buildDescription($row['NomMenu'], $row['IDMenu'])
            );
        }
        
        return null;  // Si aucun menu n'est trouvé, on retourne null
    }

    public static function getByRestaurantId($restaurantId) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM Menu WHERE IDRestaurant = :restaurantId ORDER BY IDMenu DESC");
        $stmt->bindParam(':restaurantId', $restaurantId);
        $stmt->execute();

        $menus = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $menus[] = new Menu(
                $row['IDMenu'],
                $row['NomMenu'],
                $row['PrixMenu'],
                $row['IDRestaurant'] ?? null,
                self::resolveImageByName($row['NomMenu']),
                self::buildDescription($row['NomMenu'], $row['IDMenu'])
            );
        }
        return $menus;
    }

    public static function create($nom, $prix, $restaurantId) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO Menu (NomMenu, PrixMenu, IDRestaurant) VALUES (:nom, :prix, :restaurantId)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':restaurantId', $restaurantId);
        return $stmt->execute();
    }

    public static function update($id, $nom, $prix, $restaurantId) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE Menu SET NomMenu = :nom, PrixMenu = :prix, IDRestaurant = :restaurantId WHERE IDMenu = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':restaurantId', $restaurantId);
        return $stmt->execute();
    }

    public static function delete($id) {
        $db = Database::connect();
        $id = (int)$id;

        try {
            $db->beginTransaction();

            $stmt = $db->prepare("DELETE FROM Choix_du_plat_dans_le_menu WHERE IDMenu = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM Commande_du_Menu WHERE IDMenu = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM Menu WHERE IDMenu = :id");
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