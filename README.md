

# **Task Manager Application**

## **Description**
Cette application est un gestionnaire de tâches simple qui permet de :
- Créer, lire, mettre à jour et supprimer des tâches via une API Symfony.
- Afficher et interagir avec les tâches à l'aide d'une interface utilisateur React.

Le projet est composé d’un **backend Symfony** qui sert une API REST et d’un **frontend React** pour l’interaction utilisateur.

---

## **Architecture**
### **Backend**
- **Framework** : Symfony
- **Base de données** : MySQL
- **EndPoints principaux** :
  - **POST** `/tasks` : Crée une tâche.
  - **GET** `/tasks` : Liste toutes les tâches.
  - **PUT** `/tasks/{id}` : Met à jour une tâche.
  - **DELETE** `/tasks/{id}` : Supprime une tâche.

### **Frontend**
- **Framework** : React
- **Gestion des appels API** : Axios
- **Composants principaux** :
  - `TaskForm` : Composant pour ajouter de nouvelles tâches.
  - `TaskList` : Composant pour afficher et gérer les tâches.
  - `TaskModal` : Composant pour modifier une tâche dans une fenêtre modale.

---

## **Installation**

### **1. Backend **
#### **Étape 1 : Cloner le projet**
```bash
git clone <lien_du_projet>
cd backend
```

#### **Étape 2 : Installer les dépendances**
```bash
composer install
```

#### **Étape 3 : Configurer la base de données**
- Configurez votre fichier `.env` :
  ```env
  DATABASE_URL="mysql://user:password@127.0.0.1:3306/task_api"
  ```
  Remplacez `user`, `password` et `task_api` par vos informations de connexion MySQL.

#### **Étape 4 : Créer la base de données**
```bash
php bin/console doctrine:database:create
php bin/console make:migration
php bin/console doctrine:migrations:migrate
```

#### **Étape 5 : Lancer le serveur**
```bash
symfony server:start
```
L’API sera disponible à l’adresse `http://localhost:8000`.

---

### **2. Frontend**
#### **Étape 1 : Cloner le projet**
```bash
cd frontend
```

#### **Étape 2 : Installer les dépendances**
```bash
npm install
```

#### **Étape 3 : Lancer l’application**
```bash
npm start
```
L’interface sera disponible à `http://localhost:3000`.

---

## **Utilisation**

### **Ajouter une tâche**
1. Remplissez les champs "Titre", "Description", et sélectionnez un statut dans le formulaire.
2. Cliquez sur **"Ajouter"** pour envoyer la tâche au serveur.

### **Lister les tâches**
- Les tâches existantes seront affichées automatiquement dans la liste.

### **Modifier une tâche**
1. Cliquez sur le bouton **"Modifier"** à côté d’une tâche.
2. Une fenêtre modale s’affiche. Apportez vos modifications et cliquez sur **"Enregistrer"**.

### **Supprimer une tâche**
- Cliquez sur le bouton **"Supprimer"** pour supprimer une tâche.

---



