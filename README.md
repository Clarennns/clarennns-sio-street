# Clarennns SIO Street 🍔

![Statut du Projet](https://img.shields.io/badge/Statut-Projet%20Scolaire-blue)
![Langage](https://img.shields.io/badge/Langage-PHP-777bb4)
![Architecture](https://img.shields.io/badge/Architecture-MVC-orange)

## 📝 Description

**Clarennns SIO Street** est une application web de restauration rapide développée dans le cadre de ma formation en **BTS SIO (Services Informatiques aux Organisations)**, option **SLAM**.

L'objectif principal de ce projet était de mettre en place une architecture logicielle robuste de type **MVC** (Modèle-Vue-Contrôleur) afin de séparer la logique métier, les données et l'interface utilisateur. Le site permet aux administrateurs de gérer dynamiquement la carte du restaurant.

## ✨ Fonctionnalités

* **Gestion des menus (CRUD) :**
    * **Saisie :** Ajouter de nouveaux plats et menus via un formulaire dédié.
    * **Consultation :** Affichage dynamique des produits disponibles.
    * **Modification :** Mettre à jour les prix, descriptions ou noms des produits.
    * **Suppression :** Retirer des plats de la carte en temps réel.
* **Interface utilisateur :** Design moderne et intuitif pour faciliter la navigation.

## 🛠️ Technologies utilisées

* **Langage :** PHP 8+
* **Architecture :** Modèle-Vue-Contrôleur (MVC)
* **Base de données :** MySQL
* **Frontend :** HTML5, CSS3 (Sora Font), JavaScript
* **Outils :** Git, Visual Studio Code

## 🚀 Installation et Utilisation

### Prérequis
* Un serveur local (WAMP, MAMP, XAMPP ou Laragon).
* PHP 7.4 ou supérieur.
* MySQL.

### Installation
1.  **Cloner le dépôt :**
    ```bash
    git clone [https://github.com/Clarennns/clarennns-sio-street.git](https://github.com/Clarennns/clarennns-sio-street.git)
    ```
2.  **Importer la base de données :**
    * Ouvrez PHPMyAdmin.
    * Créez une base de données nommée `sio_street` (ou le nom spécifié dans votre config).
    * Importez le fichier `.sql` fourni dans le dossier `database/` ou `sql/`.
3.  **Configuration :**
    * Modifiez le fichier de configuration (souvent `config.php` ou `db_connect.php`) pour y insérer vos identifiants de base de données.
4.  **Lancer le projet :**
    * Placez le dossier dans votre répertoire `www/` ou `htdocs/`.
    * Accédez au site via `localhost/clarennns-sio-street`.

## 📂 Structure du projet

```text
├── controllers/    # Logique de contrôle (gestion des requêtes)
├── models/         # Interaction avec la base de données
├── views/          # Fichiers d'affichage (HTML/PHP)
├── public/         # Assets (CSS, JS, Images)
├── config/         # Fichiers de configuration DB
└── index.php       # Point d'entrée de l'application
