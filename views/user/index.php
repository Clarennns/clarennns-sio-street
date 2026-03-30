<?php
require_once 'models/Menu.php';
require_once 'models/Plat.php';

class MenuController {

    public function index() {
        $menus = Menu::getAll();
        require 'views/menu/index.php';
    }

    public function show($id) {
        $menu = Menu::getById((int)$id);
        if (!$menu) {
            header("Location: index.php?controller=menu&action=index");
            exit;
        }
        $plats = Plat::getByMenuId($id);
        require 'views/menu/show.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
            $prix = floatval($_POST['prix'] ?? 0);
            $imagePath = null;

            if (!empty($_FILES['image']['name'])) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                $fileName = basename($_FILES['image']['name']);
                $targetFile = $uploadDir . uniqid() . '_' . $fileName;
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif']) &&
                    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = $targetFile;
                }
            }

            Menu::create($nom, $prix, $imagePath);
            header('Location: index.php?controller=menu&action=index');
            exit;
        }
        require 'views/menu/create.php';
    }

    public function update($id) {
        $menu = Menu::getById((int)$id);
        if (!$menu) {
            header("Location: index.php?controller=menu&action=index");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = htmlspecialchars(trim($_POST['nom'] ?? ''));
            $prix = floatval($_POST['prix'] ?? 0);
            $imagePath = $menu->getImage();

            if (!empty($_FILES['image']['name'])) {
                $uploadDir = 'uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                $fileName = basename($_FILES['image']['name']);
                $targetFile = $uploadDir . uniqid() . '_' . $fileName;
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif']) &&
                    move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                    $imagePath = $targetFile;
                }
            }

            Menu::update($id, $nom, $prix, $imagePath);
            header('Location: index.php?controller=menu&action=index');
            exit;
        }

        require 'views/menu/update.php';
    }

    public function delete($id) {
        if (Menu::getById((int)$id)) {
            Menu::delete((int)$id);
        }
        header('Location: index.php?controller=menu&action=index');
        exit;
    }
}