<?php

// Charger les dépendances nécessaires
require_once __DIR__ . '/../models/Model.php'; // Inclure le modèle pour accéder à la base de données

/**
 * Contrôleur pour la page d'accueil
 */

// Récupérer la connexion à la base de données via le modèle
$model = Model::getInstance();
$conn = $model->getConnection();

// Exemple : Récupérer tous les jeux dans la base de données
$query = $conn->prepare("SELECT * FROM jeux"); // Remplace "jeux" par le nom réel de ta table
$query->execute();
$games = $query->fetchAll(PDO::FETCH_ASSOC); // Récupère les résultats sous forme de tableau associatif

// Charger la vue associée
require_once __DIR__ . '/../views/index.php'; // Inclure la vue (par exemple, index.php)
