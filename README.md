# Déploiement Automatisé d'une Application Web de Gestion des Tâches

## Contexte du Projet

Ce projet a été réalisé dans le cadre de l'enseignement du module DevOps et Intégration Continue. Il consiste à mettre en place un environnement complet permettant le déploiement automatisé d'une application web de gestion de tâches (type Trello minimaliste) dans un environnement cloud local. Le projet repose sur une architecture DevOps, combinant Infrastructure as Code (IaC), CI/CD avec Jenkins, et orchestration via Kubernetes.

## Objectifs

- Automatiser la création et la configuration de deux machines virtuelles (une pour Jenkins, une pour Kubernetes).
- Développer une petite application web (type TODO list).
- Mettre en place un pipeline CI/CD avec Jenkins.
- Déployer l'application dans un cluster Kubernetes.
- Utiliser les bonnes pratiques de gestion de projet avec Git.

## 1. Infrastructure as Code (IaC)

Le provisioning de l'infrastructure est réalisé à l'aide de Vagrant. Le `Vagrantfile` permet de créer deux VMs :

- **VM1 (Jenkins)** : héberge Jenkins, Docker et Git.
- **VM2 (Kubernetes)** : héberge un cluster Kubernetes (Minikube) avec Docker, NGINX et PostgreSQL.

Les configurations de base (réseaux privés, mémoire, CPU, etc.) sont définies dans le `Vagrantfile`.

## 2. Application Web

L’application développée est une simple TODO list écrite en [préciser ici : Node.js / Flask / Java Spring Boot]. Elle permet :

- L’ajout de tâches
- La suppression de tâches
- La consultation de l’ensemble des tâches

Le code source est versionné sur GitHub dans ce dépôt.

## 3. Intégration Continue avec Jenkins

Un pipeline CI/CD a été mis en place avec Jenkins. Il permet :

- Le clonage automatique du dépôt GitHub
- L’exécution de tests unitaires
- La construction de l’image Docker de l’application
- Le push de l’image sur DockerHub
- Le déploiement automatique de l’application sur Kubernetes via `kubectl`

## 4. Déploiement Kubernetes

Les fichiers YAML utilisés pour le déploiement sont présents dans le dossier `k8s/` :

- `deployment.yaml` : décrit le déploiement de l’application
- `service.yaml` : expose l’application via un NodePort

## 5. Git et Gestion de Projet

- Le projet utilise une structure de branches : `master` pour la version stable et `dev` pour les développements.
- Un fichier `.gitignore` a été configuré pour ignorer les fichiers non pertinents.
- Une Pull Request a été simulée pour montrer l’intégration de nouvelles fonctionnalités avec validation.

## Arborescence du Projet 
TODO-LIST/
├── app/ # Code source de l'application
├── Jenkinsfile/ # Fichiers de configuration Jenkins 
├── k8s/ # Fichiers YAML pour Kubernetes
├── Dockerfile 
├── Vagrantfile # Provisionnement des VMs
├── README.md # Description du projet
├── .gitignore


## Conclusion

Ce projet m’a permis de mettre en œuvre une chaîne complète DevOps allant de la configuration de l’infrastructure jusqu’au déploiement automatique de l’application web. J’ai pu appliquer concrètement les concepts d’IaC, de CI/CD avec Jenkins, de conteneurisation avec Docker, et d’orchestration avec Kubernetes.



