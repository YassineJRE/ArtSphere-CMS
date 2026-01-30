# ArtSphere-CMS 🎨

Une application web robuste basée sur **Laravel** pour la gestion complète de contenus artistiques, d'expositions et de collections. Ce projet utilise une architecture MVC stricte et intègre des fonctionnalités avancées de gestion des droits et de médias.

## 🌟 Fonctionnalités Principales

### Gestion de Contenu
* **Artworks & Collections** : Gestion détaillée des œuvres et regroupement en collections.
* **Exhibits** : Organisation et suivi des expositions virtuelles ou physiques.
* **Documents & Media** : Centralisation des contenus multimédias associés aux œuvres.

### Gestion des Utilisateurs & Sécurité
* **Système de Rôles** : Distinction claire entre les types d'utilisateurs (Member, Artist).
* **Permissions Avancées** : Système granulaire (Privilege, PrivilegeAdmin, PrivilegeAuthentication).
* **Profils** : Gestion des profils utilisateurs avec différents types (ProfileType).

### Outils & Interactions
* **Notifications** : Système d'invitations et d'alertes par email.
* **Activité** : Journalisation des actions (ActivityLog) pour le suivi administratif.
* **Social** : Système de commentaires et statuts vérifiés (VerifiedStatus).

## 🔧 Architecture Technique

Ce projet démontre une maîtrise du framework Laravel et des bonnes pratiques de développement :

* **Pattern MVC** : Séparation stricte (Controllers, Models, Services, Repositories).
* **API & Web** : Routes distinctes pour l'interface web et les accès API.
* **Événementiel** : Utilisation d'Events & Listeners pour découpler la logique métier.
* **Qualité du Code** :
    * Validation des données via *Form Requests*.
    * Tests unitaires et fonctionnels intégrés.

## 🚀 Installation

1. **Cloner le projet**
   ```bash
   git clone [https://github.com/VOTRE-NOM/ArtSphere-CMS.git](https://github.com/VOTRE-NOM/ArtSphere-CMS.git)
