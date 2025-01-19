<?php

class Controller_jeuPresentation extends Controller
{
    /**
     * Action par défaut : Affiche la présentation d'un jeu spécifique
     */
    public function action_default()
    {
        $this->action_presentation();
    }

    /**
     * Affiche la page de présentation d'un jeu
     */
    public function action_presentation()
    {
        // Inclure les fichiers de début et de fin de vue
        require_once 'view_begin.php'; // Inclusion de view_begin.php

        // Récupération du modèle
        $model = Model::getInstance();

        // Récupération du titre du jeu à partir des paramètres GET
        if (!isset($_GET['jeu']) || empty($_GET['jeu'])) {
            $this->action_error("Aucun jeu spécifié !");
            require_once 'view_end.php'; // Inclusion de view_end.php en cas d'erreur
            return;
        }

        $titre_jeu = htmlspecialchars($_GET['jeu']); // Sécurisation des entrées

        // Récupération des informations du jeu
        $jeu_info = $model->getJeu($titre_jeu);
        if (empty($jeu_info)) {
            $this->action_error("Le jeu spécifié n'existe pas !");
            require_once 'view_end.php'; // Inclusion de view_end.php en cas d'erreur
            return;
        }

        $jeu_info = $jeu_info[0]; // Supposons qu'il y ait un seul jeu avec ce titre

        // Récupération du nombre d'exemplaires pour ce jeu
        $nb_exemplaires = $model->getNbExemplaire($jeu_info['id_jeu']);

        // Récupération des jeux similaires par catégorie
        $jeux_similaires = $model->getJeuParCategorie($jeu_info['categorie']);

        // Préparation des données à passer à la vue
        $data = [
            'jeu' => $jeu_info,
            'nb_exemplaires' => $nb_exemplaires,
            'jeux_similaires' => $jeux_similaires,
        ];

        // Affichage des données du jeu
        echo "<h1>Présentation du Jeu : " . htmlspecialchars($jeu_info['nom']) . "</h1>";
        echo "<p><strong>Description :</strong> " . htmlspecialchars($jeu_info['description']) . "</p>";
        echo "<p><strong>Nombre d'exemplaires :</strong> " . $nb_exemplaires . "</p>";
        
        echo "<h2>Jeux Similaires :</h2>";
        echo "<ul>";
        foreach ($jeux_similaires as $jeu_similaire) {
            echo "<li>" . htmlspecialchars($jeu_similaire['nom']) . " - " . htmlspecialchars($jeu_similaire['categorie']) . "</li>";
        }
        echo "</ul>";

        // Inclure le fichier de fin de vue
        require_once 'view_end.php'; // Inclusion de view_end.php
    }
}

?>
