<?php

class Controller_recherche extends Controller
{
    /**
     * Action par défaut : afficher la page recherche.
     */
    public function action_default()
    {
        $this->action_rechercheAvancee();
    }

    public function action_rechercheAvancee() {

        $m = Model::getModel();
        $data = [
            "categorie" => $m->getCategories(),
            "date"=>$m->getDateDeSortie(),
            "nbJoueur"=>$m->getNbJoueurs(),
        ];
        
        if (isset($_GET["titre"])){
            if (!empty($_GET["titre"]))
            {
                $data = [
                    "lesTitres"=>$m->getJeuParTitre($_GET["titre"]),
                ];
            $this->render("resultatRecherche", $data);}
        }
        if (isset($_GET["categorie"]) or isset($_GET["nbJoueur"]) or isset($_GET["dateSortie"])){
            if (empty($_GET["categorie"])){
                $categorie = null;
            }
            else {
                $categorie = $_GET["categorie"];
            }
            if (empty($_GET["nbJoueur"])){
                $nbJoueur = null;
            }
            else {
                $nbJoueur = $_GET["nbJoueur"];
            }
            if (empty($_GET["dateSortie"])){
                $dateSortie = null;
            }
            else {
                $dateSortie = $_GET["dateSortie"];
            }
            $data = [
                "lesTitres"=>$m->getJeuxAvecFiltres($categorie, $nbJoueur, $dateSortie),
            ];

            $this->render("resultatRecherche", $data);
        }

        else {
            $this->render("rechercheAvancee", $data) ;
        }
    }

}

