<?php
require_once 'config/database.php';

class Plat {
    private $id;
    private $nom;
    private $prix;
    private $image;
    private $description;
    private static $imageIndex = null;

    public function __construct($id, $nom, $prix, $image = null, $description = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prix = $prix;
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

    public function getImage() {
        return $this->image;
    }

    public function getDescription() {
        return $this->description;
    }

    private static function buildDescription($nom, $id) {
        $base = trim((string)$nom);
        if ($base === '') {
            $base = 'ce plat';
        }

        $catalog = [
            'salade cesar' => "Salade croquante, poulet tendre, copeaux de parmesan et sauce cesar onctueuse maison.",
            'steak frites' => "Piece de boeuf saisie a la demande, servie avec des frites dorees et croustillantes.",
            'tiramisu' => "Dessert italien cremeux au cafe, biscuits moelleux et cacao, legerement sucre.",
            'pizza margherita' => "Sauce tomate mijotee, mozzarella fondante et basilic frais sur une pate croustillante.",
            'pizza 4 fromages' => "Melange gourmand de fromages fondants, equilibre entre douceur, caractere et filant.",
            'buddha bowl falafel' => "Bowl vegetarien complet avec falafels croustillants, legumes frais et sauce parfumee.",
            'soupe de saison' => "Soupe veloutee preparee avec les legumes du moment pour une entree reconfortante."
        ];

        $normalizedBase = self::normalizeImageKey($base);
        foreach ($catalog as $label => $description) {
            if (self::normalizeImageKey($label) === $normalizedBase) {
                return $description;
            }
        }

        $styles = [
            "%s est cuisine minute pour conserver une texture genereuse et des saveurs nettes en bouche.",
            "Avec %s, on retrouve une recette equilibree entre gourmandise, assaisonnement precis et finition soignee.",
            "%s valorise des ingredients choisis et une cuisson maitrisee pour un resultat savoureux a chaque service.",
            "Ce %s est pense pour offrir une experience complete, du premier parfum a la derniere bouchee.",
            "%s propose une composition harmonieuse, avec un dressage simple et efficace qui met le gout au premier plan."
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

        foreach ($candidates as $name) {
            foreach (['png', 'jpg', 'jpeg', 'webp'] as $ext) {
                $file = $name . '.' . $ext;
                if (file_exists($imagesDir . $file)) {
                    return '/site_restaurant_mvc_v2_correct/images/' . rawurlencode($file);
                }
            }
        }

        $index = self::getImageIndex($imagesDir);

        $normalizedCandidates = [];
        $normalizedCandidates[] = self::normalizeImageKey($base);

        $withoutBurger = preg_replace('/^burger\s+/i', '', $base);
        if ($withoutBurger !== null && $withoutBurger !== $base) {
            $normalizedCandidates[] = self::normalizeImageKey($withoutBurger);
        }

        $burgerNaanToNaan = preg_replace('/^burger\s+naan\s+/i', 'naan ', $base);
        if ($burgerNaanToNaan !== null && $burgerNaanToNaan !== $base) {
            $normalizedCandidates[] = self::normalizeImageKey($burgerNaanToNaan);
        }

        foreach ($normalizedCandidates as $key) {
            if ($key !== '' && isset($index[$key])) {
                return '/site_restaurant_mvc_v2_correct/images/' . rawurlencode($index[$key]);
            }
        }

        foreach ($normalizedCandidates as $wanted) {
            if ($wanted === '') {
                continue;
            }
            foreach ($index as $existingKey => $filename) {
                if (str_contains($wanted, $existingKey) || str_contains($existingKey, $wanted)) {
                    return '/site_restaurant_mvc_v2_correct/images/' . rawurlencode($filename);
                }
            }
        }

        return null;
    }

    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT IDPlat, NomPlat, PrixPlat FROM Plat ORDER BY IDPlat DESC");

        $plats = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $plats[] = new Plat(
                $row['IDPlat'],
                $row['NomPlat'],
                $row['PrixPlat'],
                self::resolveImageByName($row['NomPlat']),
                self::buildDescription($row['NomPlat'], $row['IDPlat'])
            );
        }

        return $plats;
    }

    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT IDPlat, NomPlat, PrixPlat FROM Plat WHERE IDPlat = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Plat(
                $row['IDPlat'],
                $row['NomPlat'],
                $row['PrixPlat'],
                self::resolveImageByName($row['NomPlat']),
                self::buildDescription($row['NomPlat'], $row['IDPlat'])
            );
        }

        return null;
    }

    public static function create($nom, $prix) {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO Plat (NomPlat, PrixPlat) VALUES (:nom, :prix)");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prix', $prix);
        return $stmt->execute();
    }

    public static function update($id, $nom, $prix) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE Plat SET NomPlat = :nom, PrixPlat = :prix WHERE IDPlat = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prix', $prix);
        return $stmt->execute();
    }

    public static function delete($id) {
        $db = Database::connect();
        $id = (int)$id;

        try {
            $db->beginTransaction();

            $stmt = $db->prepare("DELETE FROM Choix_du_plat_dans_le_menu WHERE IDPlat = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM Commande_du_plat WHERE IDPlat = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            // Table utilisee par le module de commandes recentes.
            $stmt = $db->prepare("DELETE FROM commandes WHERE plat_id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $stmt = $db->prepare("DELETE FROM Plat WHERE IDPlat = :id");
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

    // Méthode pour récupérer les plats d'un menu
    public static function getByMenuId($menuId) {
        // Connexion à la base de données
        $db = Database::connect();
        
        // Préparation de la requête SQL
        $stmt = $db->prepare("SELECT Plat.IDPlat, Plat.NomPlat, Plat.PrixPlat 
                             FROM Plat 
                             JOIN Choix_du_plat_dans_le_menu 
                             ON Plat.IDPlat = Choix_du_plat_dans_le_menu.IDPlat
                             WHERE Choix_du_plat_dans_le_menu.IDMenu = :menuId");
        
        // Liaison du paramètre :menuId à la variable
        $stmt->bindParam(':menuId', $menuId);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Tableau des plats
        $plats = [];
        
        // Récupérer les résultats et les ajouter dans le tableau
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $plats[] = new Plat(
                $row['IDPlat'],
                $row['NomPlat'],
                $row['PrixPlat'],
                self::resolveImageByName($row['NomPlat']),
                self::buildDescription($row['NomPlat'], $row['IDPlat'])
            );
        }
        
        // Retourner les plats associés à ce menu
        return $plats;
    }
}
?>