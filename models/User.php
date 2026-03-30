<?php
require_once 'config/database.php';

class User {
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $password;
    private $role;

    public function __construct($id, $nom, $prenom, $email, $password, $role = 'client', $is_hashed = false) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->role = $role;
        $this->password = $is_hashed ? $password : password_hash($password, PASSWORD_DEFAULT);
    }

    // Getters
    public function getId()     { return $this->id; }
    public function getNom()    { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getEmail()  { return $this->email; }
    public function getPassword() { return $this->password; }
    public function getRole()   { return $this->role; }

    // Vérifie le mot de passe
    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }

    // Enregistre l'utilisateur dans la base
    public function save() {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO users (nom, prenom, email, password, role) VALUES (:nom, :prenom, :email, :password, :role)");
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        return $stmt->execute();
    }

    // Récupère un utilisateur par email
    public static function getByEmail($email) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['password'], $row['role'], true);
        }
        return null;
    }

    // Récupère un utilisateur par ID
    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['id'], $row['nom'], $row['prenom'], $row['email'], $row['password'], $row['role'], true);
        }

        return null;
    }

    // Met à jour les informations de profil (et mot de passe si fourni)
    public static function updateProfile($id, $nom, $prenom, $email, $hashedPassword = null) {
        $db = Database::connect();

        if ($hashedPassword !== null) {
            $stmt = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, email = :email, password = :password WHERE id = :id");
            $stmt->bindParam(':password', $hashedPassword);
        } else {
            $stmt = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, email = :email WHERE id = :id");
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }
}