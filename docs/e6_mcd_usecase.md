# Dossier E6 - MCD et Use Case

## Contexte
Application web MVC de gestion de restaurants, menus et plats, avec authentification utilisateur.

## Exigences E6 couvertes
- Base relationnelle avec jeu d'essai realistie
- Association 1,1 vers 1,N : Restaurant -> Menu
- Association 1,N vers 1,N porteuse de donnees : Menu <-> Plat via Choix_du_plat_dans_le_menu (Quantite)
- CRUD : Restaurant, Menu, Plat
- Inscription avec complexite du mot de passe
- Connexion avec mot de passe chiffre (hash)

## MCD (Merise)

```mermaid
erDiagram
    USERS {
        INT id PK
        VARCHAR nom
        VARCHAR prenom
        VARCHAR email "UNIQUE"
        VARCHAR password "hash"
        ENUM role "client|restaurateur|vendeur"
    }

    RESTAURANT {
        INT IDRestaurant PK
        VARCHAR NomRestaurant
        VARCHAR VilleRestaurant
        VARCHAR AdresseRestaurant
        VARCHAR CodePostaleRestaurant
    }

    MENU {
        INT IDMenu PK
        VARCHAR NomMenu
        DECIMAL PrixMenu
        INT IDRestaurant FK
    }

    PLAT {
        INT IDPlat PK
        VARCHAR NomPlat
        DECIMAL PrixPlat
    }

    CHOIX_DU_PLAT_DANS_LE_MENU {
        INT IDMenu PK,FK
        INT IDPlat PK,FK
        INT Quantite
    }

    RESTAURANT ||--o{ MENU : propose
    MENU ||--o{ CHOIX_DU_PLAT_DANS_LE_MENU : compose
    PLAT ||--o{ CHOIX_DU_PLAT_DANS_LE_MENU : entre_dans
```

Cardinalites Merise :
- RESTAURANT (1,1) - possede - MENU (0,N)
- MENU (1,N) - contient - PLAT (0,N) via CHOIX_DU_PLAT_DANS_LE_MENU[Quantite]

## Use Case

```mermaid
flowchart LR
    V[Visiteur]
    C[Client authentifie]
    A[Administrateur]

    UC1((S'inscrire))
    UC2((Se connecter))
    UC3((Consulter restaurants))
    UC4((Consulter menus d'un restaurant))
    UC5((Consulter plats d'un menu))
    UC6((Gerer profil))
    UC7((Ajouter au panier))
    UC8((Modifier/Supprimer panier))
    UC9((CRUD Restaurant))
    UC10((CRUD Menu))
    UC11((CRUD Plat))
    UC12((Associer plats a un menu\nvia quantites))

    V --> UC1
    V --> UC2
    V --> UC3
    V --> UC4
    V --> UC5

    C --> UC6
    C --> UC7
    C --> UC8
    C --> UC3
    C --> UC4
    C --> UC5

    A --> UC9
    A --> UC10
    A --> UC11
    A --> UC12
```

## Traceabilite rapide vers le projet
- Schema SQL : database/schema_e6.sql
- Inscription/connexion : controllers/UserController.php et models/User.php
- CRUD Restaurant : controllers/RestaurantController.php
- CRUD Menu : controllers/MenuController.php
- CRUD Plat : controllers/PlatController.php
- Illustration 1,N vers 1,N : models/Plat.php (getByMenuId)
