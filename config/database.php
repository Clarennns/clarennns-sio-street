<?php
class Database {
    private static $host = 'localhost';
    private static $dbname = 'restaurant_db';  // Nom de ta base de données
    private static $user = 'root';              // Nom d'utilisateur de ta base de données
    private static $password = '';              // Mot de passe de l'utilisateur
    private static $pdo;

    // Méthode pour établir la connexion à la base de données
    public static function connect() {
        // Si la connexion PDO n'a pas encore été établie
        if (self::$pdo == null) {
            try {
                // Création de la connexion avec la base de données MySQL
                self::$pdo = new PDO(
                    'mysql:host=' . self::$host . ';dbname=' . self::$dbname . ';charset=utf8',
                    self::$user,
                    self::$password
                );
                // Configurer le mode d'erreur pour afficher les exceptions
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Gestion des erreurs en cas de problème de connexion
                die('Erreur de connexion à la base de données : ' . $e->getMessage());
            }
        }
        return self::$pdo; // Retourne l'instance de la connexion PDO
    }

    // Méthode pour récupérer une instance de connexion PDO
    public static function getConnection() {
        return self::connect();
    }
}
?>