<?php

class Controller_index extends Controller
{
    public function action_index()
    {
        // On récupère le modèle
        $m = Model::getInstance(); // Utilisation de la méthode getInstance()

        $data = [
            // On récupère les jeux populaires
            "liste" => $m->getJeuxPop(),
        ];
        $this->render("index", $data); // Passe les données à la vue
    }

    public function action_default()
    {
        $this->action_index(); // Action par défaut
    }
}

?>

