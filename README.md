# SAE3.01: Développement d'une application<sub>2024-2025</sub>

## Contexte
L'Université Sorbonne Paris Nord possède une grande collection de jeux de société, incluant près de 17 000 jeux, certains datant du XIXe siècle. Cette collection nécessite une gestion rigoureuse pour garantir sa préservation et sa mise en valeur. Ce projet a pour objectif de développer une solution permettant de gérer cette collection, à travers une application web et un ensemble de scripts pour traiter et organiser les données.

## Objectifs
Le but de ce projet est de créer :
- un script pour nettoyer et importer des données issues d'un fichier Excel.
- un système de gestion de l'inventaire des jeux.
- une base de données relationnelle pour structurer les informations sur les jeux.
- une interface utilisateur simple et intuitive.

## Structure du répertoire :

Le répertoire principal est organisé comme suit : 

```bash
SAE3.01/
├───data
│       create_excel.py
│       inventaire_perso.xlsx
│       
└───script_nettoyage
        main.py
        nettoyage.py
        test_utils.py
        utils.py
        utils_test.py
```

## Fonctionnalités Principales
- **Nettoyage des données** : Traitement et correction des incohérences dans les fichiers Excel.
- **Importation des données** : Création de tables et insertion des données dans la base de données.
- **Gestion de l'inventaire** : Interface pour ajouter, supprimer, ou modifier les jeux dans l'inventaire.
- **Recherche Avancée** : Fonctionnalité de recherche par titre, auteur, catégorie, etc.
- **Suivi des prêts** : Gestion de la localisation et des prêts de jeux.

## Technologies Utilisées
- **Langages de développement** : Python, PHP
- **Base de données** : MySQL
- **Outils de modélisation** : Diagrammes Entité-Association
- **Interface utilisateur** : HTML, CSS, JavaScript

## Installation
Assurez-vous d'avoir installé la bibliothèque nécessaires en exécutant la commande suivante :
```bash
pip install pandas
```

De plus, lorsque vous lancez les fichiers, il faut **impérativement** être dans le répertoire principal donc avoir comme sous-répertoire : data/ et script_nettoyage/ .

## Equipe du projet
Ce projet est réalisé par l'équipe suivante : 
- **[Mehdi ARRAB](https://github.com/jadoothepooh/)**
- **[Lasry BESKIWIN](https://github.com/Lasryy)**
- **[Rania Bousfiha](https://github.com/rania212)**
- **[Safiya NGUYEN](https://github.com/safiya-ng)**
- **[Ahash PARTHIPAN](https://github.com/AhashPARTHIPAN)**
- **[Jules RICHARDOT](https://github.com/JulesRichardot)**
