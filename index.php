<?php
// Configuration de la connexion PDO
$host     = 'localhost';
$dbname   = 'restaurant_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
    die();
}

// Inclusion des contrôleurs
require_once 'controllers/HomeController.php';
require_once 'controllers/MenuController.php';
require_once 'controllers/PlatController.php';
require_once 'controllers/RestaurantController.php';
require_once 'controllers/ContactController.php';
require_once 'controllers/UserController.php';

// Routeur basique
$controller      = $_GET['controller'] ?? 'home';
$action          = $_GET['action']     ?? 'index';
$controllerClass = ucfirst($controller) . 'Controller';

if (class_exists($controllerClass)) {
    // Instanciation (sans $pdo, car nos controllers utilisent directement Database::connect())
    $controllerObject = new $controllerClass();

    // Si un paramètre id est fourni, le passer au méthode
    if (isset($_GET['id'])) {
        $controllerObject->$action($_GET['id']);
    } else {
        $controllerObject->$action();
    }
} else {
    header("HTTP/1.0 404 Not Found");
    echo "404 - Contrôleur '$controllerClass' introuvable.";
}