<?php
// models/Contact.php
require_once 'config/database.php';

class Contact {
    private $id;
    private $nom;
    private $email;
    private $numero;
    private $message;
    private $created_at;

    // Constructeur
    public function __construct($nom, $email, $numero, $message) {
        $this->nom = $nom;
        $this->email = $email;
        $this->numero = $numero;
        $this->message = $message;
        $this->created_at = date('Y-m-d H:i:s');
    }

    // Getter et Setter
    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    // Méthode pour enregistrer un message dans la base de données
    public static function saveMessage($nom, $email, $numero, $message) {
        // On se connecte à la base de données
        $db = Database::getConnection();

        // Préparer la requête pour insérer le message
        $query = $db->prepare('INSERT INTO Contacts (nom, email, numero, message, created_at) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$nom, $email, $numero, $message, date('Y-m-d H:i:s')]);

        // Retourner l'id du message inséré
        return $db->lastInsertId();
    }

    // Méthode pour récupérer tous les messages
    public static function getAllMessages() {
        $db = Database::getConnection();

        $query = $db->query('SELECT * FROM contacts ORDER BY created_at DESC');
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);

        return $messages;
    }
}
?>
