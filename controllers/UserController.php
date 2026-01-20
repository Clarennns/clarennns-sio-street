<?php
require_once 'models/User.php';
session_start();

class UserController {
    // Vérification des droits d'accès (admin uniquement)
    private function checkAdmin() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: index.php');
            exit();
        }
    }

    // 🔐 INSCRIPTION publique
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom        = $_POST['nom']        ?? '';
            $prenom     = $_POST['prenom']     ?? '';
            $email      = $_POST['email']      ?? '';
            $motdepasse = $_POST['motdepasse'] ?? '';

            // Rôle admin si email précis, sinon client
            $role = ($email === 'admin@example.com') ? 'admin' : 'client';

            if ($nom && $prenom && $email && $motdepasse) {
                if (! User::getByEmail($email)) {
                    $user = new User(null, $nom, $prenom, $email, $motdepasse, $role);
                    if ($user->save()) {
                        header('Location: index.php?controller=user&action=login');
                        exit();
                    } else {
                        echo "<p style='color:red;'>Erreur lors de la création de l'utilisateur.</p>";
                    }
                } else {
                    echo "<p style='color:red;'>Cet email existe déjà.</p>";
                }
            } else {
                echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
            }
        }

        require 'views/user/register.php';
    }

    // 🔐 CONNEXION
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email      = $_POST['email']      ?? '';
            $motdepasse = $_POST['motdepasse'] ?? '';

            if ($email && $motdepasse) {
                $user = User::getByEmail($email);
                if ($user && $user->verifyPassword($motdepasse)) {
                    $_SESSION['user_id']    = $user->getId();
                    $_SESSION['user_email'] = $user->getEmail();
                    $_SESSION['user_role']  = $user->getRole();
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<p style='color:red;'>Identifiants incorrects.</p>";
                }
            } else {
                echo "<p style='color:red;'>Veuillez remplir tous les champs.</p>";
            }
        }

        require 'views/user/login.php';
    }

    // 🔒 DÉCONNEXION
    public function logout() {
        // Vider la session côté serveur
        $_SESSION = [];
        session_destroy();
        header('Location: index.php');
        exit();
    }

    // 📄 LISTER les utilisateurs (admin)
    public function index() {
        $this->checkAdmin();
        $users = User::getAll();
        require 'views/user/index.php';
    }

    // ➕ FORMULAIRE création (admin)
    public function create() {
        $this->checkAdmin();
        require 'views/user/create.php';
    }

    // 💾 TRAITEMENT création (admin) — réutilise register()
    public function store() {
        $this->checkAdmin();
        $this->register();
    }

    // ✏️ FORMULAIRE édition (admin)
    public function edit($id) {
        $this->checkAdmin();
        $user = User::getById($id);
        require 'views/user/edit.php';
    }

    // 🔄 TRAITEMENT édition (admin)
    public function update($id) {
        $this->checkAdmin();
        $nom        = $_POST['nom'];
        $prenom     = $_POST['prenom'];
        $email      = $_POST['email'];
        $motdepasse = $_POST['motdepasse'];
        $role       = $_POST['role'];

        if (User::update($id, $nom, $prenom, $email, $motdepasse, $role)) {
            header('Location: index.php?controller=user&action=index');
            exit();
        } else {
            echo "<p style='color:red;'>Erreur lors de la mise à jour.</p>";
        }
    }

    // 🗑️ SUPPRESSION (admin)
    public function delete($id) {
        $this->checkAdmin();
        User::delete($id);
        header('Location: index.php?controller=user&action=index');
        exit();
    }
}