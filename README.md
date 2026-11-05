# 🤝 Solidarités Plus RDC - Application Web Officielle

Ce projet est la plateforme web dynamique de **Solidarités Plus RDC** (SOLIPLUS), développée sous le framework **Laravel**.

## 📌 1. À propos de SOLIDARITÉS PLUS RDC

**SOLIDARITÉS PLUS** est une organisation non gouvernementale (ONG) nationale de droit congolais créée en 2003, basée à Goma (Nord-Kivu, RDC).

* **Mission :** Sauver des vies et alléger les souffrances des populations les plus vulnérables en s'attaquant aux causes sous-jacentes de la pauvreté.

* **Axe stratégique majeur :** Protection intégrée et accompagnement des survivant(e)s de violences basées sur le genre (VBG), promotion de la santé et des droits sexuels et reproductifs (SDSR), lutte contre le VIH/SIDA, et autonomisation socio-économique (AVEC, MUSO, AGR).

* **Zones d'intervention prioritaires :** Province du Nord-Kivu (Axes Rutshuru, Nyiragongo, Masisi) et du Sud-Kivu.

## 🛠️ 2. Architecture du Projet Web & Répartition de l'Équipe

Le projet repose sur la conversion d'une maquette statique HTML/CSS/JS vers une application web dynamique **Laravel**.

### 👥 Répartition des Rôles :

* **Développeur Front-End :**

  * Intégration et découpage des maquettes HTML/CSS/JS statiques vers Blade (`resources/views/`).

  * Gestion des composants visuels, du responsive design, de l'accessibilité et des interactions JS.

  * Organisation et optimisation des assets (dossier `public/` et/ou compilation **Vite**).

* **Développeur Back-End :**

  * Conception et gestion de la base de données (Migrations, Seeders, Modèles Eloquent).

  * Développement de la logique métier, des contrôleurs, des formulaires (Contact, Dons, Événements, Dynamic Content).

  * Gestion de la sécurité, de l'authentification et de l'administration du contenu.

## 📋 3. Règles du Workflow Git & Collaborations

Afin de garantir un historique propre, stable et d'éviter les conflits d'intégration entre le Front-End et le Back-End, l'équipe doit appliquer strictement les règles suivantes :

### 🔀 Gestion des Branches (`Git Flow`)

* `main` / `master` : Branche de production. Ne jamais pusher directement dessus.

* `develop` : Branche principale d'intégration. Tout le travail validé y est fusionné.

* **Branches de fonctionnalités (Feature Branches) :**

  * `feature/frontend-name-page` (ex: `feature/frontend-home-blade`, `feature/frontend-css-fix`)

  * `feature/backend-feature-name` (ex: `feature/backend-donations-controller`, `feature/backend-auth`)

### 📝 Convention de Commit (Conventional Commits)

Chaque commit doit obligatoirement respecter la structure suivante :

`<type>(<scope>): <description claire et concrète>`

#### Types autorisés :

* `feat` : Nouvelle fonctionnalité (ex: `feat(front): integration de la page d'accueil en Blade`)

* `fix` : Correction d'un bug (ex: `fix(css): correction de l'alignement du menu mobile`)

* `style` : Changement d'apparence, formatage, CSS sans modification logique.

* `refactor` : Re-structuration du code sans changement de fonctionnalité.

* `docs` : Modification de la documentation ou du README.

* `chore` : Tâches de configuration (Vite, Composer, npm, etc.).

#### Exemples de bons commits :

```
git commit -m "feat(front): création du layout principal app.blade.php"
git commit -m "feat(back): mise en place des migrations pour les causes et événements"
git commit -m "fix(front): ajustement des liens de navigation du header"

```

## 🚀 4. Installation et Configuration Locale

### Prérequis

* PHP >= 8.2

* Composer

* Node.js & NPM

* MySQL / PostgreSQL

### Procédure d'installation

1. **Cloner le projet :**

   ```
   git clone <URL_DU_REPO_GITHUB>
   cd soliplus-web
   
   ```

2. **Installer les dépendances PHP :**

   ```
   composer install
   
   ```

3. **Installer les dépendances JS/CSS :**

   ```
   npm install
   
   ```

4. **Configurer l'environnement :**

   ```
   cp .env.example .env
   php artisan key:generate
   
   ```

   *(Configurer ensuite les accès à la base de données dans le fichier `.env`)*

5. **Lancer les migrations et seeders :**

   ```
   php artisan migrate --seed
   
   ```

6. **Démarrer le serveur local :**

   ```
   php artisan serve
   
   ```

   *(Et si compilation Vite nécessaire : `npm run dev`)*

## 📩 5. Contacts & Secrétariat

* **Agence de réalisation :** Solidarités Plus RDC (« SOLIPLUS »)

* **Email officiel :** `solidariteplusasbl@gmail.com`

* **Siège opérationnel :** Goma, Nord-Kivu, République Démocratique du Congo.
