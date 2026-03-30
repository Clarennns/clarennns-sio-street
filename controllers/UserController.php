<?php
require_once 'models/User.php';

class UserController {
    private function ensureSessionStarted() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function requireLogin() {
        $this->ensureSessionStarted();

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit();
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'client'; // rôle par défaut
            $passwordRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,}$/';

            if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($password) && !empty($role)) {
                if (!preg_match($passwordRegex, $password)) {
                    echo "Mot de passe invalide : minimum 8 caractères, 1 majuscule, 1 minuscule, 1 chiffre et 1 caractère spécial.";
                    require_once 'views/user/Register.php';
                    return;
                }

                $existingUser = User::getByEmail($email);
                if (!$existingUser) {
                    $user = new User(null, $nom, $prenom, $email, $password, $role);
                    if ($user->save()) {
                        header('Location: index.php?controller=user&action=login');
                        exit();
                    } else {
                        echo "Erreur lors de la création de l'utilisateur.";
                    }
                } else {
                    echo "Cet email existe déjà.";
                }
            } else {
                echo "Veuillez remplir tous les champs.";
            }
        }
        require_once 'views/user/Register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (!empty($email) && !empty($password)) {
                $user = User::getByEmail($email);
                if ($user && $user->verifyPassword($password)) {
                    $this->ensureSessionStarted();
                    $_SESSION['user_id'] = $user->getId();
                    $_SESSION['user_email'] = $user->getEmail();
                    $_SESSION['user_role'] = $user->getRole(); // si tu veux gérer des redirections plus tard
                    header('Location: index.php');
                    exit();
                } else {
                    echo "Identifiants incorrects.";
                }
            } else {
                echo "Veuillez remplir tous les champs.";
            }
        }
        require_once 'views/user/Login.php';
    }

    public function profile() {
        $this->requireLogin();

        $user = User::getById((int)$_SESSION['user_id']);
        if (!$user) {
            $this->logout();
        }

        $successMessage = null;
        $errorMessage = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';

            if ($nom === '' || $prenom === '' || $email === '') {
                $errorMessage = "Nom, prénom et email sont obligatoires.";
            } else {
                $existingWithEmail = User::getByEmail($email);
                if ($existingWithEmail && $existingWithEmail->getId() !== $user->getId()) {
                    $errorMessage = "Cet email est déjà utilisé par un autre compte.";
                } else {
                    $hashedPassword = null;
                    if ($newPassword !== '' || $confirmPassword !== '') {
                        if ($newPassword !== $confirmPassword) {
                            $errorMessage = "Les mots de passe ne correspondent pas.";
                        } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s]).{8,}$/', $newPassword)) {
                            $errorMessage = "Le nouveau mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
                        } else {
                            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                        }
                    }

                    if ($errorMessage === null) {
                        if (User::updateProfile($user->getId(), $nom, $prenom, $email, $hashedPassword)) {
                            $_SESSION['user_email'] = $email;
                            $successMessage = "Informations du compte mises à jour avec succès.";
                            $user = User::getById((int)$_SESSION['user_id']);
                        } else {
                            $errorMessage = "Une erreur est survenue lors de la mise à jour.";
                        }
                    }
                }
            }
        }

        require_once 'views/user/profile.php';
    }

    // Alias pour compatibilité avec les anciens liens
    public function index() {
        $this->profile();
    }

    public function logout() {
        $this->ensureSessionStarted();
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
        header('Location: index.php?controller=user&action=login');
        exit();
    }
}