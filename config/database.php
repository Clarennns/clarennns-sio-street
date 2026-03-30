<?php
class database {
    private static $host = 'localhost'; // Adresse du serveur
    private static $dbname = 'restaurant_db'; // Nom de la base de données
    private static $user = 'root'; // Utilisateur
    private static $password = ''; // Mot de passe
    private static $pdo;

    public static function getConnection() {
        if (self::$pdo == null) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=' . self::$host . ';dbname=' . self::$dbname . ';charset=utf8mb4',
                    self::$user,
                    self::$password
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }

    // Alias pour compatibilité avec les modèles existants
    public static function connect() {
        return self::getConnection();
    }
}