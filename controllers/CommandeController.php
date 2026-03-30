<?php
require_once 'models/Commande.php';

class CommandeController {
    // Affichage des commandes en fonction du rôle
    public function index() {
        session_start();
        $role = $_SESSION['user_role'] ?? 'client';
        $commandes = [];

        if ($role === 'client') {
            $client_id = $_SESSION['user_id'];
            $commandes = Commande::getByClientId($client_id);
        } elseif ($role === 'restaurateur') {
            $commandes = Commande::getAll();  // Restaurateurs voient toutes les commandes
        } elseif ($role === 'vendeur') {
            $commandes = Commande::getAll();  // Vendeurs voient toutes les commandes
        }

        require_once 'views/commande/index.php';
    }

    // Création d'une commande
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $client_id = $_POST['client_id'] ?? '';
            $plat_id = $_POST['plat_id'] ?? '';
            if (!empty($client_id) && !empty($plat_id)) {
                $commande = new Commande(null, $client_id, $plat_id);
                if ($commande->save()) {
                    header('Location: index.php?controller=commande&action=index');
                    exit();
                } else {
                    echo "Erreur lors de la création de la commande.";
                }
            }
        }
        require_once 'views/commande/create.php';
    }

    // Modification du statut de la commande
    public function updateStatus() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $commande = new Commande($id, null, null);
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $status = $_POST['status'] ?? '';
                if (!empty($status)) {
                    $commande->updateStatus($status);
                    header('Location: index.php?controller=commande&action=index');
                    exit();
                }
            }
            require_once 'views/commande/updateStatus.php';
        }
    }

    // Suppression d'une commande
    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $commande = new Commande($id, null, null);
            if ($commande->delete()) {
                header('Location: index.php?controller=commande&action=index');
                exit();
            }
        }
    }
}