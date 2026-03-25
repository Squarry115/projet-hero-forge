# 🏰 Forge de Héros — Application Symfony

Application fullstack + API REST de création et gestion de personnages de jeu de rôle, inspirée de l'univers de Donjons & Dragons.

---

## 📋 Prérequis

- PHP 8.4+
- Composer 2+
- Symfony CLI 5+

---

## 🚀 Installation

### 1. Cloner le dépôt

```bash
git clone <url-du-repo>
cd projet-hero-forge
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer la base de données

Copier le fichier `.env` et configurer SQLite :

```bash
cp .env .env.local
```

Dans `.env.local`, vérifier que la ligne suivante est présente :

```env
DATABASE_URL="sqlite:///%kernel.project_dir%/var/data.db"
```

### 4. Créer la base de données et appliquer les migrations

```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```

### 5. Charger les données de départ (fixtures)

```bash
php bin/console doctrine:fixtures:load
```

Cela charge automatiquement :
- 8 races (Humain, Elfe, Nain, Halfelin, Demi-Orc, Gnome, Tieffelin, Demi-Elfe)
- 10 classes (Barbare, Barde, Clerc, Druide, Guerrier, Mage, Paladin, Ranger, Sorcier, Voleur)
- 18 compétences associées aux classes
- Un compte administrateur

### 6. Lancer le serveur

```bash
symfony serve --no-tls
```

L'application est accessible sur **http://127.0.0.1:8000**

---

## 🔑 Compte administrateur (créé par les fixtures)

| Champ | Valeur |
|-------|--------|
| Email | admin@forge.com |
| Mot de passe | admin |

---

## 📱 Fonctionnalités

### Authentification
- Inscription / Connexion
- Le premier utilisateur inscrit obtient automatiquement le rôle `ROLE_ADMIN`
- Navigation adaptée selon le rôle (utilisateur / admin)

### Gestion des personnages
- Créer, modifier, supprimer ses propres personnages
- Upload d'une image avatar
- Système Point Buy (27 points à répartir, valeurs entre 8 et 15)
- Calcul automatique des points de vie (dé de vie + modificateur de Constitution)
- Recherche par nom, filtre par classe et race

### Groupes d'aventure
- Créer un groupe avec nom, description et taille maximum
- Inscrire / désinscrire ses personnages dans un groupe
- Filtre groupes complets / avec places disponibles

### Administration (ROLE_ADMIN uniquement)
- CRUD complet sur les races, classes et compétences
- Liste de tous les utilisateurs

---

## 🌐 API REST

L'API est accessible publiquement sous `/api/v1/`. Aucune authentification requise.

| Méthode | Route | Description |
|---------|-------|-------------|
| GET | /api/v1/races | Liste toutes les races |
| GET | /api/v1/races/{id} | Détail d'une race |
| GET | /api/v1/classes | Liste toutes les classes |
| GET | /api/v1/classes/{id} | Détail d'une classe avec ses compétences |
| GET | /api/v1/skills | Liste toutes les compétences |
| GET | /api/v1/characters | Liste tous les personnages (filtrable par `name`, `race`, `class`) |
| GET | /api/v1/characters/{id} | Détail complet d'un personnage |
| GET | /api/v1/parties | Liste tous les groupes (filtrable par `filter=full` ou `filter=available`) |
| GET | /api/v1/parties/{id} | Détail d'un groupe avec ses membres |

---

## 🗂️ Structure du projet

```
src/
├── Controller/
│   ├── Api/              # Controllers API REST
│   ├── AdminController   # Gestion admin
│   ├── CharacterController
│   ├── HomeController
│   ├── PartyController
│   ├── RegistrationController
│   └── SecurityController
├── Entity/               # Entités Doctrine
├── Form/                 # Formulaires Symfony
├── Repository/           # Repositories Doctrine
└── DataFixtures/         # Fixtures de données
templates/                # Templates Twig
```

---

## ⚙️ Variables d'environnement

| Variable | Description | Valeur par défaut |
|----------|-------------|-------------------|
| DATABASE_URL | URL de connexion SQLite | sqlite:///%kernel.project_dir%/var/data.db |
| APP_ENV | Environnement | dev |
| APP_SECRET | Clé secrète | à définir |
