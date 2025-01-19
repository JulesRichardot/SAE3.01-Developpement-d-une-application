<?php

class Controller_home extends Controller
{
    public function action_home()
    {
        $m = Model::getModel();
        $data = [
            "jeux" => $m->getTop10JeuxEmpruntes(),
            "nb_jeux" => $m->getNbJeux()  // Récupération du nombre total de jeux
        ];
        $this->render("home", $data);
    }

    public function action_default()
    {
        $this->action_home();
    }
}

