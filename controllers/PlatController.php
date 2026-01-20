<?php

require_once 'models/Plat.php';
class PlatController {

    // Afficher tous les plats
    public function index() {
        $plats = Plat::getAll();
        require 'views/plat/index.php';
    }

    // Afficher tous les plats d'un menu spécifique
    public function indexByMenu($menuId) {
        $menuId = intval($menuId); // Validation de l'ID
        $plats = Plat::getByMenuId($menuId);
        require 'views/plat/index.php';
    }

    // Afficher un plat spécifique
    public function show($id) {
        $id = intval($id); // Validation de l'ID
        $plat = Plat::getById($id);

        if (!$plat) {
            header("Location: index.php");
            exit;
        }

        require 'views/plat/show.php';
    }

    // Ajouter un plat à un menu spécifique
    public function create($menuId = null) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars(trim($_POST['nom'] ?? '')); // Nettoyage des données
            $prix = floatval($_POST['prix'] ?? 0); // Validation du prix
            $image = $_FILES['image']['name'] ?? ''; // Gestion de l'image

            if (!empty($nom) && $prix > 0) {
                // Si une image est téléchargée, on la déplace
                if ($image) {
                    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);
                }

                $plat = new Plat(null, $nom, $prix, $image);

                if ($plat->save($menuId)) {
                    $redirectUrl = $menuId 
                        ? "index.php?controller=plat&action=indexByMenu&menuId=$menuId" 
                        : "index.php?controller=plat&action=index";
                    header("Location: $redirectUrl");
                    exit();
                } else {
                    echo "Erreur lors de la création du plat.";
                }
            } else {
                echo "Veuillez remplir tous les champs correctement.";
            }
        }

        require 'views/plat/create.php';
    }

    // Modifier un plat
    public function update($id) {
        $plat = Plat::getById($id);
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars(trim($_POST['nom'] ?? '')); 
            $prix = floatval($_POST['prix'] ?? 0); 
            $image = $_FILES['image']['name'] ?? $plat->getImage(); // Si aucune image n'est envoyée, on garde l'ancienne

            if (!empty($nom) && $prix > 0) {
                // Si une nouvelle image est téléchargée, on la déplace
                if ($image && $_FILES['image']['tmp_name']) {
                    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $image);
                }

                $plat->update($nom, $prix, $image);

                $menuId = method_exists($plat, 'getMenuId') ? $plat->getMenuId() : null;
                $redirectUrl = $menuId 
                    ? "index.php?controller=plat&action=indexByMenu&menuId=$menuId" 
                    : "index.php?controller=plat&action=index";
                header("Location: $redirectUrl");
                exit();
            } else {
                echo "Veuillez remplir tous les champs correctement.";
            }
        }

        require 'views/plat/update.php';
    }

    // Supprimer un plat
    public function delete($id) {
        $id = intval($id); // Validation de l'ID
        $plat = Plat::getById($id);

        if ($plat && $plat->delete()) {
            $menuId = method_exists($plat, 'getMenuId') ? $plat->getMenuId() : null;
            $redirectUrl = $menuId 
                ? "index.php?controller=plat&action=indexByMenu&menuId=$menuId" 
                : "index.php?controller=plat&action=index";
            header("Location: $redirectUrl");
            exit();
        } else {
            echo "Erreur lors de la suppression du plat.";
        }
    }

    // Enregistrer un nouveau plat (anciennement 'store')
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $nom = $_POST['nom'];
            $prix = $_POST['prix'];
            $image = $_FILES['image']['name'];

            // Déplacer l'image téléchargée vers le dossier adéquat
            if ($image) {
                $targetDir = "images/";  // S'Assure que le dossier 'images' existe dans le projet
                $targetFile = $targetDir . basename($image);
                move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            }

            // Créer une instance de la classe Plat
            $plat = new Plat(null, $nom, $prix, $image);

            // Enregistrer le plat dans la base de données
            if ($plat->save()) {
                // Rediriger vers la page des plats après l'ajout
                header("Location: index.php?controller=plat&action=index");
                exit();
            } else {
                echo "Erreur lors de l'ajout du plat.";
            }
        }
    }
}
?>