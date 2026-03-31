<?php
require_once 'config/database.php';

class User {
    private $id;
    private $nom;
    private $prenom;
    private $dateNaissance;
    private $adresse;
    private $ville;
    private $codePostal;
    private $telephone;
    private $email;
    private $password;
    private $role;

    public function __construct(
        $id,
        $nom,
        $prenom,
        $email,
        $password,
        $role = 'client',
        $is_hashed = false,
        $dateNaissance = null,
        $adresse = null,
        $ville = null,
        $codePostal = null,
        $telephone = null
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->adresse = $adresse;
        $this->ville = $ville;
        $this->codePostal = $codePostal;
        $this->telephone = $telephone;
        $this->email = $email;
        $this->role = $role;
        $this->password = $is_hashed ? $password : password_hash($password, PASSWORD_DEFAULT);
    }

    // Getters
    public function getId()     { return $this->id; }
    public function getNom()    { return $this->nom; }
    public function getPrenom() { return $this->prenom; }
    public function getDateNaissance() { return $this->dateNaissance; }
    public function getAdresse() { return $this->adresse; }
    public function getVille() { return $this->ville; }
    public function getCodePostal() { return $this->codePostal; }
    public function getTelephone() { return $this->telephone; }
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
        $stmt = $db->prepare("INSERT INTO Personne (Nom, Prenom, DateDeNaissance, Adresse, Ville, CodePostal, `NuméroTéléphone`, Adressemail, motdepasse, Role) VALUES (:nom, :prenom, :date_naissance, :adresse, :ville, :code_postal, :telephone, :email, :password, :role)");
        $stmt->bindParam(':nom', $this->nom);
        $stmt->bindParam(':prenom', $this->prenom);
        $stmt->bindParam(':date_naissance', $this->dateNaissance);
        $stmt->bindParam(':adresse', $this->adresse);
        $stmt->bindParam(':ville', $this->ville);
        $stmt->bindParam(':code_postal', $this->codePostal);
        $stmt->bindParam(':telephone', $this->telephone);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':role', $this->role);
        return $stmt->execute();
    }

    // Récupère un utilisateur par email
    public static function getByEmail($email) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM Personne WHERE Adressemail = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new User(
                $row['Id'],
                $row['Nom'],
                $row['Prenom'],
                $row['Adressemail'],
                $row['motdepasse'],
                $row['Role'],
                true,
                $row['DateDeNaissance'] ?? null,
                $row['Adresse'] ?? null,
                $row['Ville'] ?? null,
                $row['CodePostal'] ?? null,
                $row['NuméroTéléphone'] ?? null
            );
        }
        return null;
    }

    // Récupère un utilisateur par ID
    public static function getById($id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM Personne WHERE Id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User(
                $row['Id'],
                $row['Nom'],
                $row['Prenom'],
                $row['Adressemail'],
                $row['motdepasse'],
                $row['Role'],
                true,
                $row['DateDeNaissance'] ?? null,
                $row['Adresse'] ?? null,
                $row['Ville'] ?? null,
                $row['CodePostal'] ?? null,
                $row['NuméroTéléphone'] ?? null
            );
        }

        return null;
    }

    // Met à jour les informations de profil (et mot de passe si fourni)
    public static function updateProfile($id, $nom, $prenom, $email, $hashedPassword = null) {
        $db = Database::connect();

        if ($hashedPassword !== null) {
            $stmt = $db->prepare("UPDATE Personne SET Nom = :nom, Prenom = :prenom, Adressemail = :email, motdepasse = :password WHERE Id = :id");
            $stmt->bindParam(':password', $hashedPassword);
        } else {
            $stmt = $db->prepare("UPDATE Personne SET Nom = :nom, Prenom = :prenom, Adressemail = :email WHERE Id = :id");
        }

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }
}