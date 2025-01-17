<?php

class Controller_Recherche extends Controller
{
  
    public function action_default()
    {
        $this->action_recherche();
    }

    /**
     * Action pour effectuer la recherche
     */
    public function action_recherche()
    {
        // Vérifier si un terme de recherche a été passé
        if (!isset($_GET['terme']) || empty($_GET['terme'])) {
            $this->action_error("Aucun terme de recherche spécifié.");
            return;
        }

        $termeRecherche = htmlspecialchars($_GET['terme']); // Sécuriser le terme de recherche

        $model = Model::getInstance();

        // Appeler la méthode de recherche dans le modèle
        $resultats = $model->searchJeux($termeRecherche);

        if (empty($resultats)) {
            // Si aucun résultat n'est trouvé, afficher un message d'erreur
            $this->action_error("Aucun jeu trouvé pour '$termeRecherche'.");
            return;
        }

        // Passer les résultats de la recherche à la vue
        $this->render("recherche_resultats", [
            'terme' => $termeRecherche,
            'resultats' => $resultats
        ]);
    }
}
