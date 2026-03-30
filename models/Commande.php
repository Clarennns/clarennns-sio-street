<?php
require_once 'config/database.php';

class Commande {
    private $id;
    private $client_id;
    private $plat_id;
    private $status; // Ex : en préparation, prêt à être livré, etc.
    private $date_commande;

    public function __construct($id, $client_id, $plat_id, $status = 'en attente', $date_commande = null) {
        $this->id = $id;
        $this->client_id = $client_id;
        $this->plat_id = $plat_id;
        $this->status = $status;
        $this->date_commande = $date_commande ? $date_commande : date('Y-m-d H:i:s');
    }

    // Getters
    public function getId() { return $this->id; }
    public function getClientId() { return $this->client_id; }
    public function getPlatId() { return $this->plat_id; }
    public function getStatus() { return $this->status; }
    public function getDateCommande() { return $this->date_commande; }

    // Sauvegarde la commande dans la base
    public function save() {
        $db = Database::connect();
        $stmt = $db->prepare("INSERT INTO commandes (client_id, plat_id, status, date_commande) 
                              VALUES (:client_id, :plat_id, :status, :date_commande)");
        $stmt->bindParam(':client_id', $this->client_id);
        $stmt->bindParam(':plat_id', $this->plat_id);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':date_commande', $this->date_commande);
        return $stmt->execute();
    }

    // Récupère toutes les commandes
    public static function getAll() {
        $db = Database::connect();
        $stmt = $db->query("SELECT * FROM commandes");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $commandes = [];
        foreach ($result as $row) {
            $commandes[] = new Commande($row['id'], $row['client_id'], $row['plat_id'], $row['status'], $row['date_commande']);
        }
        return $commandes;
    }

    // Récupère toutes les commandes d'un client
    public static function getByClientId($client_id) {
        $db = Database::connect();
        $stmt = $db->prepare("SELECT * FROM commandes WHERE client_id = :client_id");
        $stmt->bindParam(':client_id', $client_id);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $commandes = [];
        foreach ($result as $row) {
            $commandes[] = new Commande($row['id'], $row['client_id'], $row['plat_id'], $row['status'], $row['date_commande']);
        }
        return $commandes;
    }

    // Modifie le statut d'une commande
    public function updateStatus($newStatus) {
        $db = Database::connect();
        $stmt = $db->prepare("UPDATE commandes SET status = :status WHERE id = :id");
        $stmt->bindParam(':status', $newStatus);
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }

    // Supprime une commande
    public function delete() {
        $db = Database::connect();
        $stmt = $db->prepare("DELETE FROM commandes WHERE id = :id");
        $stmt->bindParam(':id', $this->id);
        return $stmt->execute();
    }
}