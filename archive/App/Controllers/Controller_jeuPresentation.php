<?php

class Controller_JeuPresentation extends Controller
{
    /**
     * Action par défaut - présentation d'un jeu spécifique
     */
    public function action_default()
    {
        $this->action_presentation();
    }

    /**
     * Action pour afficher les détails d'un jeu
     */
    public function action_presentation()
    {
        if (!isset($_GET['jeu'])) {
            // Si aucun jeu n'est spécifié, afficher une erreur
            $this->action_error("Aucun jeu spécifié.");
            return;
        }

        $jeuTitre = htmlspecialchars($_GET['jeu']); // Échapper pour éviter les injections
        $model = Model::getInstance();

        // Récupérer les données du jeu
        $jeu = $model->getJeu($jeuTitre);
        if (empty($jeu)) {
            // Si le jeu n'existe pas, afficher une erreur
            $this->action_error("Le jeu '$jeuTitre' n'existe pas.");
            return;
        }

        // Récupérer le nombre d'exemplaires pour ce jeu
        $idJeu = $jeu[0]['id_jeu'];
        $nbExemplaires = $model->getNbExemplaire($idJeu);

        // Récupérer les jeux similaires (par catégorie, par exemple)
        $categorie = $jeu[0]['categorie'] ?? null; // Assurez-vous que la catégorie existe dans la table
        $jeuxSimilaires = $categorie ? $model->getJeuParCategorie($categorie) : [];

        // Passer les données à la vue
        $this->render("jeu_presentation", [
            'jeu' => $jeu[0],
            'nbExemplaires' => $nbExemplaires,
            'jeuxSimilaires' => $jeuxSimilaires,
        ]);
    }
}
