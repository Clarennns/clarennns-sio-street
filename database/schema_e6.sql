-- =====================================================
-- Schéma SQL E6 - Application Restaurant MVC
-- MySQL / MariaDB
-- =====================================================

DROP TABLE IF EXISTS Choix_du_plat_dans_le_menu;
DROP TABLE IF EXISTS Plat;
DROP TABLE IF EXISTS Menu;
DROP TABLE IF EXISTS Restaurant;
DROP TABLE IF EXISTS users;

-- Utilisateurs (inscription / connexion)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('client', 'restaurateur', 'vendeur') NOT NULL DEFAULT 'client'
);

-- Restaurant
CREATE TABLE Restaurant (
    IDRestaurant INT AUTO_INCREMENT PRIMARY KEY,
    NomRestaurant VARCHAR(150) NOT NULL,
    VilleRestaurant VARCHAR(100) NOT NULL,
    AdresseRestaurant VARCHAR(200) NOT NULL,
    CodePostaleRestaurant VARCHAR(10) NOT NULL
);

-- Menu : relation 1,N avec Restaurant
-- 1 restaurant -> N menus
CREATE TABLE Menu (
    IDMenu INT AUTO_INCREMENT PRIMARY KEY,
    NomMenu VARCHAR(150) NOT NULL,
    PrixMenu DECIMAL(8,2) NOT NULL,
    IDRestaurant INT NOT NULL,
    CONSTRAINT fk_menu_restaurant
        FOREIGN KEY (IDRestaurant) REFERENCES Restaurant(IDRestaurant)
        ON DELETE RESTRICT ON UPDATE CASCADE
);

-- Plat
CREATE TABLE Plat (
    IDPlat INT AUTO_INCREMENT PRIMARY KEY,
    NomPlat VARCHAR(150) NOT NULL,
    PrixPlat DECIMAL(8,2) NOT NULL
);

-- Association N,N Menu <-> Plat (porteuse de données: Quantite)
CREATE TABLE Choix_du_plat_dans_le_menu (
    IDMenu INT NOT NULL,
    IDPlat INT NOT NULL,
    Quantite INT NOT NULL DEFAULT 1,
    PRIMARY KEY (IDMenu, IDPlat),
    CONSTRAINT fk_choix_menu
        FOREIGN KEY (IDMenu) REFERENCES Menu(IDMenu)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT fk_choix_plat
        FOREIGN KEY (IDPlat) REFERENCES Plat(IDPlat)
        ON DELETE CASCADE ON UPDATE CASCADE
);

-- =====================================================
-- Jeu d'essai réaliste
-- =====================================================

INSERT INTO users (nom, prenom, email, password, role) VALUES
('Dupont', 'Alice', 'alice.client@mail.com', '$2y$10$qRbO8/tHxe6Sa.YEylv9D.e9myx/XH9fW8o0gVr5w4fK9Y4S4vQsa', 'client'),
('Martin', 'Bruno', 'bruno.resto@mail.com', '$2y$10$qRbO8/tHxe6Sa.YEylv9D.e9myx/XH9fW8o0gVr5w4fK9Y4S4vQsa', 'restaurateur'),
('Petit', 'Chloé', 'chloe.vendeur@mail.com', '$2y$10$qRbO8/tHxe6Sa.YEylv9D.e9myx/XH9fW8o0gVr5w4fK9Y4S4vQsa', 'vendeur');
-- mot de passe de test correspondant : Test@1234

INSERT INTO Restaurant (NomRestaurant, VilleRestaurant, AdresseRestaurant, CodePostaleRestaurant) VALUES
('Le Bistrot du Centre', 'Lyon', '12 Rue Victor Hugo', '69002'),
('Casa Napoli', 'Marseille', '8 Avenue du Prado', '13006'),
('Green Bowl', 'Toulouse', '25 Allées Jean Jaurès', '31000');

INSERT INTO Menu (NomMenu, PrixMenu, IDRestaurant) VALUES
('Menu Midi', 19.90, 1),
('Menu Dégustation', 39.90, 1),
('Menu Pizza + Boisson', 14.50, 2),
('Menu Veggie', 17.90, 3);

INSERT INTO Plat (NomPlat, PrixPlat) VALUES
('Salade César', 8.50),
('Steak Frites', 14.90),
('Tiramisu', 6.50),
('Pizza Margherita', 11.00),
('Pizza 4 Fromages', 12.50),
('Buddha Bowl Falafel', 13.50),
('Soupe de saison', 6.90);

INSERT INTO Choix_du_plat_dans_le_menu (IDMenu, IDPlat, Quantite) VALUES
(1, 1, 1),
(1, 2, 1),
(1, 3, 1),
(2, 1, 1),
(2, 2, 1),
(2, 3, 1),
(3, 4, 1),
(3, 5, 1),
(4, 6, 1),
(4, 7, 1);
