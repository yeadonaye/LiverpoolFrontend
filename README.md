⚽ Liverpool FC Manager – Frontend
📌 Présentation du projet

Le Frontend Liverpool FC Manager est une interface web conçue pour gérer un système de gestion d’équipe de football.
Il permet aux utilisateurs d’interagir avec des API backend pour gérer l’authentification, les joueurs, les matchs et les données statistiques.

Ce frontend fait partie d’un système distribué en 3 couches composé de :

Frontend (ce dépôt)
API REST Backend
API d’authentification (basée sur JWT)

L’application est déployée sur AlwaysData et communique avec des API PHP sécurisées via une authentification JWT.

🚀 Application en ligne
🌐 Frontend : [https://liverpool.alwaysdata.net/](https://liverpool.alwaysdata.net/)
🔐 Auth API : [https://liverpoolapi.alwaysdata.net/authapi.php](https://liverpoolapi.alwaysdata.net/authapi.php)
⚙️ Backend API : [https://yeadonaye.alwaysdata.net/Routes/](https://yeadonaye.alwaysdata.net/Routes/)

🧑‍💻 Projet d’équipe

Ce projet a été réalisé dans le cadre d’un travail universitaire à :

IUT Paul Sabatier – Toulouse

👥 Contributeurs
Nathan HISABU
Yeadonaye SENTAYEHU

🎯 Fonctionnalités principales

🔐 Système d’authentification
Connexion basée sur JWT
Contrôle d’accès basé sur les rôles :
Coach (accès CRUD complet)
Joueur (accès en lecture seule aux statistiques)
Validation de session via requêtes API

👥 Gestion des joueurs
Voir la liste des joueurs
Ajouter de nouveaux joueurs (coach uniquement)
Modifier les informations des joueurs
Supprimer des joueurs
Données des joueurs :
Nom, prénom
Date de naissance
Poids / taille
Statut (disponible, blessé, etc.)

⚽ Gestion des matchs
Voir tous les matchs (accès public possible)
Créer de nouveaux matchs (coach uniquement)
Modifier les résultats des matchs
Supprimer des matchs
Détails affichés :
Équipe adverse
Score
Date et heure
Lieu

📋 Feuille de match
Affecter des joueurs aux matchs
Définir :
Composition titulaire (11 joueurs minimum)
Remplaçants
Postes des joueurs
Notes de performance
Remplacement complet dynamique de la feuille de match

📊 Tableau de bord des statistiques
Statistiques globales de l’équipe :
Nombre total de matchs
Victoires / défaites / nuls
Buts marqués / encaissés
Taux de victoire

Statistiques des joueurs :
Matchs joués
Note moyenne
Taux de participation
Tendances de performance

🏗️ Architecture

Le système suit une architecture en 3 couches :

Frontend (ce dépôt)
↓
API REST Backend (PHP)
↓
Base de données (MariaDB sur AlwaysData)

🔗 Services connectés

Composant | Description | URL
Frontend | Interface utilisateur | [https://liverpool.alwaysdata.net/](https://liverpool.alwaysdata.net/)
Backend API | Logique métier football (CRUD) | [https://yeadonaye.alwaysdata.net/Routes/](https://yeadonaye.alwaysdata.net/Routes/)
Auth API | Service d’authentification JWT | [https://liverpoolapi.alwaysdata.net/authapi.php](https://liverpoolapi.alwaysdata.net/authapi.php)

🔐 Flux d’authentification

L’utilisateur se connecte via le frontend
Les identifiants sont envoyés à l’Auth API
Un token JWT est retourné
Le token est stocké dans la session du frontend
Chaque requête inclut :
Authorization: Bearer <JWT_TOKEN>
Le backend valide le token avant traitement

🧠 Stack technique

Frontend
HTML5
CSS3
JavaScript (vanilla ou framework selon implémentation)

Communication backend
API REST (PHP)
Format JSON
Authentification JWT

DevOps
Hébergement AlwaysData
GitHub Actions (CI/CD)
Déploiement automatique via FTP lors des push

🔄 Pipeline CI/CD

Chaque dépôt inclut un déploiement automatisé :

Push sur la branche main
Déclenchement du workflow GitHub Actions
Déploiement automatique via FTP sur AlwaysData
Mise à jour instantanée du site en ligne

🧪 Comptes de test

Coach (accès complet)
login : coach1
password : Liverpool2025

Joueur (lecture seule)
login : joueur1
password : Liverpool2025

📁 Structure du projet

LiverpoolFrontend/
│
├── index.html
├── login.html
├── dashboard.html
├── players.html
├── matches.html
├── stats.html
│
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
│
├── services/
│   ├── api.js
│   ├── auth.js
│
└── README.md

🔑 Responsabilités du frontend

Ce dépôt gère :

Le rendu de l’interface utilisateur
La communication avec les API
Le stockage du token d’authentification
L’affichage basé sur les rôles
La visualisation des données (joueurs, matchs, statistiques)

Il ne fait pas :

Stockage de données en base
Logique métier
Vérification d’authentification (gérée par l’Auth API)

📌 Exemple de communication API

Requête de login
POST /authapi.php
Content-Type: application/json
{
"login": "coach1",
"password": "Liverpool2025"
}

Requête authentifiée
GET /Routes/joueurapi.php
Authorization: Bearer <JWT_TOKEN>

⚠️ Remarques importantes

Durée de vie du token : 1 heure
Le frontend ne valide pas les tokens localement
Toutes les vérifications de sécurité sont gérées par les services backend
Des restrictions CORS s’appliquent à l’Auth API (uniquement domaine frontend)

📊 Objectifs du projet

Ce projet démontre :

Développement web full-stack
Intégration d’API REST
Systèmes d’authentification (JWT)
Architecture multi-dépôts
Pipeline de déploiement CI/CD
Organisation de projet réel

📈 Améliorations futures (si extension)

Migration React/Vue
Amélioration UI/UX
Mise à jour en temps réel des matchs
Notifications en temps réel (WebSockets)
Tableau de bord analytique avancé

📫 Auteurs
Nathan HISABU
Yeadonaye SENTAYEHU
