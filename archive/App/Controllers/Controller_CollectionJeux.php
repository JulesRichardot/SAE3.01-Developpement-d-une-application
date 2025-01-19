<?php

class Controller_CollectionJeux extends Controller
{
    /**
     * Action par défaut - afficher la collection de jeux
     */
    public function action_default()
    {
        $this->action_afficherCollection();
    }

    /**
     * Action pour afficher la collection complète des jeux
     */
    public function action_afficherCollection()
    {
        $model = Model::getInstance();

        // Récupérer tous les jeux disponibles dans la collection
        $jeux = $model->getTousLesJeux();
        if (empty($jeux)) {
            // Si aucun jeu n'est trouvé, afficher une erreur
            $this->action_error("Aucun jeu n'est disponible dans la collection.");
            return;
        }

        // Passer les données à la vue
        $this->render("collection_jeux", [
            'jeux' => $jeux,
        ]);
    }
}
