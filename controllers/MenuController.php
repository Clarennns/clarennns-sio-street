<?php
require_once 'models/Menu.php';  // S'Assure que Menu.php est inclus pour accéder à la classe Menu
require_once 'models/Plat.php';  // S'Assure que Plat.php est inclus pour accéder à la classe Plat

class MenuController {

    // Afficher tous les menus
    public function index() {
        $menus = Menu::getAll();
        require 'views/menu/index.php';
    }

    // Afficher un menu spécifique avec ses plats
    public function show($id) {
        $menu = Menu::getById($id);

        if (!$menu) {
            header("Location: index.php");
            exit;
        }

        // Récupérer les plats associés au menu
        $plats = Plat::getByMenuId($id);  // Assurez-vous que la méthode getByMenuId est définie dans Plat.php

        // Passer les données à la vue
        require 'views/menu/show.php';
    }

    // Ajouter un menu
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $prix = $_POST['prix'] ?? '';
            $imagePath = null;

            // Gestion de l'image si uploadée
            if (!empty($_FILES['image']['name'])) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                $fileName = basename($_FILES['image']['name']);
                $targetFile = $uploadDir . uniqid() . '_' . $fileName;

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                        $imagePath = $targetFile;
                    }
                }
            }

            Menu::create($nom, $prix, $imagePath);
            header('Location: index.php?controller=menu&action=index');
            exit;
        } else {
            require 'views/menu/create.php';
        }
    }

    // Modifier un menu (changement ici pour update au lieu de edit)
    public function update($id) {
        $menu = Menu::getById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $prix = $_POST['prix'] ?? '';
            $imagePath = $menu->getImage(); // Conserver l'ancienne image

            if (!empty($_FILES['image']['name'])) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                $fileName = basename($_FILES['image']['name']);
                $targetFile = $uploadDir . uniqid() . '_' . $fileName;

                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                        $imagePath = $targetFile;
                    }
                }
            }

            Menu::update($id, $nom, $prix, $imagePath);
            header('Location: index.php?controller=menu&action=index');
            exit;
        } else {
            if (!$menu) {
                header("Location: index.php");
                exit;
            }
            require 'views/menu/update.php'; // S'Assurez que cette vue existe bien
        }
    }

    // Supprimer un menu
    public function delete($id) {
        $menu = Menu::getById($id);

        if (!$menu) {
            header("Location: index.php");
            exit;
        }

        Menu::delete($id);
        header('Location: index.php?controller=menu&action=index');
        exit;
    }
}
?>