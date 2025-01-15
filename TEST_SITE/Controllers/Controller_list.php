<?php

class Controller_list extends Controller
{
    public function action_last()
    {
        $m = Model::getModel();
        $data = [
            "jeux" => $m->getLast25(),
        ];
        $this->render("home", $data);
    }

    public function action_default()
    {
        $this->action_last();
    }

    public function action_detailsBoite()
    {
        $data = false;

        if (isset($_GET["id"]) and preg_match("/^[1-9]\d*$/", $_GET["id"])) {
            $m = Model::getInstance();
            $data = $m->getDetailsBoite($_GET["id"]);
        }
        //Si on a bien un prix nobel d'identifiant$_GET["id"]
        if ($data !== false) {
            $this->render("informations", $data);
        } else {
            $this->action_error("Il n'y a pas de boîte avec cette identifiant.");
        }
    }


    public function action_pagination()
{
    $start = isset($_GET["start"]) && preg_match("/^\d+$/", $_GET["start"]) ? $_GET["start"] : 1;
    $m = Model::getModel();
    $nb_jeux = $m->getNbJeux();
    $nb_total_pages = ceil($nb_jeux / 25);

    if ($start > $nb_total_pages) {
        $this->action_error("Page inexistante");
    }

    $offset = ($start - 1) * 25;
    $jeux = $m->getJeuxWithLimit($offset, 25);
    $debut = max(1, $start - 5);
    $fin = min($debut + 9, $nb_total_pages);

    $data = [
        'jeux' => $jeux,
        'active' => $start,
        'debut' => $debut,
        'fin' => $fin,
        'nb_total_pages' => $nb_total_pages
    ];

    $this->render("pagination", $data);
}


}