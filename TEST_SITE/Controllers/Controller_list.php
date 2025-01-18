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

    public function action_jeuPresentation() {
        $data = false;

        if (isset($_GET["id_jeu"]) and preg_match("/^[1-9]\d*$/", $_GET["id_jeu"])) {
            $m = Model::getModel();
            $data = [ "unJeux" => $m->getJeuParId($_GET["id_jeu"]),
            "nb_boite" => $m->getNbBoite($_GET["id_jeu"]),
            "jeuSim" => $m->getJeuSimilaire($_GET["id_jeu"]),
        ];
        }
        
        //Si on a bien un jeu d'identifiant$_GET["id"]
        if ($data !== false) {
            $this->render("jeuPresentation", $data);
        } else {
            $this->action_error("Pas de jeu avec cet id !");
        }
    }

public function action_rechercheParMotCle() {
    $m = Model::getModel();
    $data = [
        "categorie" => $m->getCategories(),
        "date" => $m->getDateDeSortie(),
        "nbJoueur" => $m->getNbJoueurs(),
    ];
    if (isset($_GET["mot_cle"])) {
        $resultats = $m->getParMotCle($_GET["mot_cle"]);
        if (!empty($resultats)) {
            $data["lesTitres"] = $resultats;
            // Afficher les résultats dans la vue home.php
            $this->render("resultatRecherche", $data);
        } else {
            $this->action_error("Aucun jeu trouvé avec ce mot-clé !");
        }
    } else {
        $this->render("home", $data);
    }
}
    public function action_boiteJeu() {
        $model = Model::getModel();
        
        if (isset($_GET["id_jeu"]) and preg_match("/^[1-9]\d*$/", $_GET["id_jeu"])) {
            // Récupération de toutes les boîtes associées au jeu
            $boitesDisponibles = $model->getBoitesDisponibles($_GET["id_jeu"]);
            
            if ($boitesDisponibles === false || empty($boitesDisponibles)) {
                $this->action_error("Aucune boîte disponible pour ce jeu.");
                return; // Arrêter l'exécution si aucune boîte n'est trouvée
            }
            
            // Récupération des informations sur le jeu
            $jeuInfo = $model->getJeuParId($_GET["id_jeu"]);
            if ($jeuInfo === false) {
                $this->action_error("Aucun jeu trouvé avec cet identifiant.");
                return;
            }
    
            // Récupération des jeux similaires
            $jeuxSimilaires = $model->getJeuSimilaire($_GET["id_jeu"]);
            
            $data = [
                'jeu' => $jeuInfo, // Informations sur le jeu
                'boites' => $boitesDisponibles, // Toutes les boîtes disponibles
                'nb_exemplaires' => count($boitesDisponibles), // Nombre de boîtes disponibles
                'jeux_similaires' => $jeuxSimilaires // Jeux similaires
            ];
    
            $this->render("boiteJeu", $data);
        } else {
            $this->action_error("Identifiant de jeu invalide.");
        }
    }

    public function action_pagination()
    {
        $start = 1;
        if (isset($_GET["start"]) and preg_match("/^\d+$/", $_GET["start"]) and $_GET["start"] > 0) {
            $start = $_GET["start"];
        }

        $m = Model::getModel();

        //Récupération du nombre total de prix nobel
        $nb_jeux = $m->getNbJeux();

        $nb_total_pages = ceil($nb_jeux / 25);
        if ($nb_total_pages < $start) {
            $this->action_error("The page does not exist!");
        }

        //Détermination du premier résultat à récupérer dans la base de données
        $offset = ($start - 1) * 25;

        //Détermination du début et de la fin des numéros de page à afficher
        $debut = $start - 5;
        if($debut <= 0 ){
            $debut = 1;
        }
        
        $fin = $debut + 9;
        if($fin > $nb_total_pages){
            $fin = $nb_total_pages;
        }
        
        $data = [
            //Nb prix nobels
            'nb_total_pages' => $nb_total_pages,

            //indice de la page de résultats visualisée
            'active' => $start,

            //Récupération des prix nobel de la page $start
            'liste' => $m->getJeuxWithLimit($offset, 25),

            //Début et fin des urls des pages
            'debut' => $debut,

            'fin' => $fin
        ];

        //Affichage de la vue
        $this->render("pagination", $data);
    }

   
}

?>
