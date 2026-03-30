# SIO Street 🍔

![Statut du Projet](https://img.shields.io/badge/Statut-Projet%20Scolaire-blue)
![Langage](https://img.shields.io/badge/Langage-PHP-777bb4)
![Architecture](https://img.shields.io/badge/Architecture-MVC-orange)

## 📝 Description

**Clarennns SIO Street** est une application web de restauration rapide développée dans le cadre de ma formation en **BTS SIO (Services Informatiques aux Organisations)**, option **SLAM**.

L'objectif principal de ce projet est de mettre en place une architecture logicielle robuste de type **MVC** (Modèle-Vue-Contrôleur) afin de séparer la logique métier, les données et l'interface utilisateur. Le site permet notamment aux administrateurs de gérer dynamiquement la carte du restaurant.

## ✨ Fonctionnalités

* **Gestion des menus (CRUD complet) :**
    * **Saisie :** Ajouter de nouveaux plats et menus via un formulaire dédié.
    * **Consultation :** Affichage dynamique des produits disponibles en base de données.
    * **Modification :** Mettre à jour les prix, descriptions ou noms des produits.
    * **Suppression :** Retirer des plats de la carte en temps réel.
* **Interface utilisateur :** Design moderne utilisant la police **Sora** pour une expérience intuitive.

## 🛠️ Technologies utilisées

* **Langage :** PHP 8+
* **Architecture :** Modèle-Vue-Contrôleur (MVC)
* **Base de données :** MySQL
* **Frontend :** HTML5, CSS3 (Sora Font), JavaScript
* **Outils :** Git, Visual Studio Code, Laragon/WAMP

## 🚀 Installation et Utilisation

### Prérequis
* Un serveur local (WAMP, MAMP, XAMPP ou Laragon).
* PHP 8.0 ou supérieur.
* MySQL.

### Installation
1.  **Cloner le dépôt :**
    ```bash
    git clone [https://github.com/Clarennns/clarennns-sio-street.git](https://github.com/Clarennns/clarennns-sio-street.git)
    ```
2.  **Importer la base de données :**
    * Ouvrez PHPMyAdmin.
    * Créez une base de données nommée `sio_street`.
    * Importez le fichier `.sql` fourni dans le dossier de base de données.
3.  **Configuration :**
    * Modifiez le fichier de configuration dans `config/` pour y insérer vos identifiants de base de données (host, dbname, user, password).
4.  **Lancer le projet :**
    * Placez le dossier dans votre répertoire `www/` ou `htdocs/`.
    * Accédez au site via `http://localhost/clarennns-sio-street`.

## 📂 Structure du projet

```text
├── controllers/    # Logique de contrôle (gestion des requêtes et aiguillage)
├── models/         # Interaction avec la base de données (Requêtes PDO)
├── views/          # Fichiers d'affichage (Templates HTML/PHP)
├── public/         # Assets (CSS avec Sora Font, JS, Images des burgers)
├── config/         # Connexion à la base de données
└── index.php       # Routeur et point d'entrée unique de l'application
