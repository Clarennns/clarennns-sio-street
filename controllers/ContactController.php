<?php
// controllers/ContactController.php

require_once __DIR__ . '/../models/Contact.php';  // Inclure la classe Contact

class ContactController {
    // Affichage de la page de contact
    public function index($successMessage = '') {
        require_once __DIR__ . '/../views/contact/index.php';
    }

    // Traitement du formulaire de contact
    public function send() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Vérifier si les clés existent dans le tableau $_POST et définir des valeurs par défaut
            $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
            $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
            $numero = isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : '';
            $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';

            // Enregistrer le message dans la base de données
            $messageId = Contact::saveMessage($nom, $email, $numero, $message);

            // Si tout va bien, on redirige vers la page contact avec un message de succès
            $successMessage = "Merci de nous avoir contacté, $nom ! Nous avons bien reçu votre message.";
            $this->index($successMessage);
        } else {
            header('Location: index.php?controller=contact&action=index');
        }
    }
}
?>