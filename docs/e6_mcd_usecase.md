# Dossier E6 - Use Case et MCD

## 1) Diagramme de cas d'utilisation (Use Case)

Objectif : representer les acteurs, les cas metier, et les relations <<include>> / <<extend>> comme sur ton exemple.

Acteurs retenus :

- Visiteur
- Client (heritage de Visiteur)
- Restaurateur (heritage de Visiteur)

```plantuml
@startuml
left to right direction
skinparam packageStyle rectangle

actor Visiteur
actor Client
actor Restaurateur

Client --|> Visiteur
Restaurateur --|> Visiteur

rectangle "Systeme Site Restaurant MVC" {
	usecase "Consulter restaurants" as UC_SeeRestaurants
	usecase "Consulter menus d'un restaurant" as UC_SeeMenusByRestaurant
	usecase "Consulter details menu" as UC_SeeMenuDetails
	usecase "Consulter plats d'un menu" as UC_SeePlatsByMenu

	usecase "S'inscrire" as UC_Register
	usecase "Valider complexite\nmot de passe" as UC_PwdPolicy
	usecase "Se connecter" as UC_Login
	usecase "Verifier mot de passe\nhashe" as UC_PwdHashCheck

	usecase "Gerer panier" as UC_Cart
	usecase "Ajouter article panier" as UC_CartAdd
	usecase "Modifier quantite" as UC_CartUpdate
	usecase "Supprimer article" as UC_CartRemove

	usecase "Gerer restaurants (CRUD)" as UC_CRUD_Restaurant
	usecase "Gerer menus (CRUD)" as UC_CRUD_Menu
	usecase "Gerer plats (CRUD)" as UC_CRUD_Plat
	usecase "Associer plat a menu" as UC_LinkPlatMenu
	usecase "Definir quantite du plat\ndans le menu" as UC_SetQty
}

Visiteur --> UC_SeeRestaurants
Visiteur --> UC_SeeMenusByRestaurant
Visiteur --> UC_SeeMenuDetails
Visiteur --> UC_Register
Visiteur --> UC_Login

Client --> UC_Cart

Restaurateur --> UC_CRUD_Restaurant
Restaurateur --> UC_CRUD_Menu
Restaurateur --> UC_CRUD_Plat
Restaurateur --> UC_LinkPlatMenu

UC_SeeMenusByRestaurant ..> UC_SeeRestaurants : <<include>>
UC_SeeMenuDetails ..> UC_SeePlatsByMenu : <<include>>
UC_Register ..> UC_PwdPolicy : <<include>>
UC_Login ..> UC_PwdHashCheck : <<include>>

UC_CartAdd ..> UC_Cart : <<extend>>
UC_CartUpdate ..> UC_Cart : <<extend>>
UC_CartRemove ..> UC_Cart : <<extend>>

UC_SetQty ..> UC_LinkPlatMenu : <<extend>>

note right of UC_Cart
	extension points
	- ajout_article
	- mise_a_jour_quantite
	- suppression_article
end note

note right of UC_LinkPlatMenu
	extension point
	- quantite_personnalisee
end note

@enduml
```

## 2) MCD (Merise)

Objectif : representer les entites, associations et cardinalites conformes aux exigences E6.

### Entites

- UTILISATEUR(id, nom, prenom, email, password, role)
- RESTAURANT(IDRestaurant, NomRestaurant, VilleRestaurant, AdresseRestaurant, CodePostaleRestaurant)
- MENU(IDMenu, NomMenu, PrixMenu)
- PLAT(IDPlat, NomPlat, PrixPlat)

### Associations et cardinalites

- POSSEDE entre RESTAURANT et MENU
  - RESTAURANT (1,1)
  - MENU (0,N)
- COMPOSER entre MENU et PLAT, porteuse de donnee Quantite
  - MENU (1,N)
  - PLAT (0,N)
  - attribut d'association : Quantite

```mermaid
erDiagram
		UTILISATEUR {
				INT id PK
				VARCHAR nom
				VARCHAR prenom
				VARCHAR email
				VARCHAR password
				VARCHAR role
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

		RESTAURANT ||--o{ MENU : POSSEDE
		MENU ||--|{ CHOIX_DU_PLAT_DANS_LE_MENU : COMPOSER
		PLAT ||--o{ CHOIX_DU_PLAT_DANS_LE_MENU : ETRE_CHOISI
```

### Lecture rapide du MCD

- Un restaurant propose zero a plusieurs menus, et chaque menu est rattache a un restaurant.
- Un menu contient un ou plusieurs plats.
- Un plat peut apparaitre dans zero a plusieurs menus.
- La quantite est portee par l'association entre menu et plat.
