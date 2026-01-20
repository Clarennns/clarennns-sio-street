<?php
require_once 'config/database.php';

class User {
    private $id;
    private $nom;
    private $prenom;
    private $adressemail;
    private $motdepasse;
    private $role;

    public function __construct($id, $nom, $prenom, $adressemail, $motdepasse, $role = 'client', $is_hashed = false) {
        $this->id          = $id;
        $this->nom         = $nom;
        $this->prenom      = $prenom;
        $this->adressemail = $adressemail;
        $this->role        = $role;
        // Ne pas double-hacher
        $this->motdepasse  = $is_hashed ? $motdepasse : password_hash($motdepasse, PASSWORD_DEFAULT);
    }

    // Getters...
    public function getId()         { return $this->id; }
    public function getNom()        { return $this->nom; }
    public function getPrenom()     { return $this->prenom; }
    public function getEmail()      { return $this->adressemail; }
    public function getMotdepasse() { return $this->motdepasse; }
    public function getRole()       { return $this->role; }

    // Vérification
    public function verifyPassword($plain) {
        return password_verify($plain, $this->motdepasse);
    }

    // Enregistrement
    public function save() {
        $db = Database::getConnection();
        try {
            $sql = "
                INSERT INTO Personne
                  (Nom, Prenom, Adressemail, motdepasse, Role)
                VALUES
                  (:nom, :prenom, :email, :motdepasse, :role)
            ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nom',        $this->nom);
            $stmt->bindParam(':prenom',     $this->prenom);
            $stmt->bindParam(':email',      $this->adressemail);
            $stmt->bindParam(':motdepasse', $this->motdepasse);
            $stmt->bindParam(':role',       $this->role);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur PDO (save): " . $e->getMessage();
            return false;
        }
    }

    // Récupérations
    public static function getByEmail($email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM Personne WHERE Adressemail = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new User(
                $row['Id'],
                $row['Nom'],
                $row['Prenom'],
                $row['Adressemail'],
                $row['motdepasse'],
                $row['Role'],
                true
            );
        }
        return null;
    }

    public static function getAll() {
        $db = Database::getConnection();
        $stmt = $db->query("SELECT * FROM Personne");
        $users = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $users[] = new User(
                $row['Id'],
                $row['Nom'],
                $row['Prenom'],
                $row['Adressemail'],
                $row['motdepasse'],
                $row['Role'],
                true
            );
        }
        return $users;
    }

    public static function getById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM Personne WHERE Id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            return new User(
                $row['Id'],
                $row['Nom'],
                $row['Prenom'],
                $row['Adressemail'],
                $row['motdepasse'],
                $row['Role'],
                true
            );
        }
        return null;
    }

    public static function update($id, $nom, $prenom, $adressemail, $motdepasse, $role) {
        $db = Database::getConnection();
        try {
            $sql = "
                UPDATE Personne
                SET
                  Nom        = :nom,
                  Prenom     = :prenom,
                  Adressemail= :email,
                  motdepasse = :motdepasse,
                  Role       = :role
                WHERE Id = :id
            ";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nom',        $nom);
            $stmt->bindParam(':prenom',     $prenom);
            $stmt->bindParam(':email',      $adressemail);
            $stmt->bindParam(':motdepasse', $motdepasse);
            $stmt->bindParam(':role',       $role);
            $stmt->bindParam(':id',         $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur PDO (update): " . $e->getMessage();
            return false;
        }
    }

    public static function delete($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("DELETE FROM Personne WHERE Id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Méthode pour vérifier si l'utilisateur est un administrateur
    public static function isAdmin() {
        // On suppose que l'utilisateur connecté est stocké en session sous 'user'
        return isset($_SESSION['user']) && $_SESSION['user']->getRole() === 'admin';
    }
}
?>