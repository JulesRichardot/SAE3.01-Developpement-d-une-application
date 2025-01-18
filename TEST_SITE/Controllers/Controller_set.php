<?php

class Controller_set extends Controller
{
    public function action_form_add()
    {
        $m = Model::getModel();
        $data = [
            "categories" => $m->getCategories(),
        ];
        $this->render("form_add", $data);
    }

    public function action_default()
    {
        $this->action_form_add();
    }

    public function action_form_update()
    {
        $in_database = false;
        if (isset($_GET["id_jeu"]) && preg_match("/^[1-9]\d*$/", $_GET["id_jeu"])) {
            $m = Model::getModel();
            $in_database = $m->getJeuParId($_GET["id_jeu"]) !== False; // Vérification de l'existence du jeu dans la base de données
        }

        if ($in_database) {
            // Récupération des informations du jeu
            $informations = $m->getInformationsDuJeu($_GET["id_jeu"]);  // Méthode qui récupère les infos du jeu en fonction de l'ID

            // Préparation de $data avec les informations récupérées
            $data = [];
            foreach ($informations as $c => $v) {
                if ($v === null) {
                    $data[$c] = "";  // Si la donnée est vide, on la transforme en chaîne vide
                } else {
                    $data[$c] = $v;
                }
            }

            // Affichage du formulaire de mise à jour
            $this->render("form_update", $data);  // Appel du modèle de vue pour afficher le formulaire avec les données
        } else {
            // Si l'ID du jeu n'existe pas dans la base de données, afficher un message d'erreur
            $this->action_error("There is no game with such ID!!! It cannot be updated!!!");
        }
    }

    public function action_update(){
        $in_database = false;
        if (isset($_POST["id_jeu"]) && preg_match("/^[1-9]\d*$/", $_POST["id_jeu"])
            && isset($_POST["titre_jeu"]) && !preg_match("/^_*$/", $_POST["titre_jeu"])
            && isset($_POST["date_parution_debut"]) && preg_match("/^[12]\d{3}$/", $_POST["date_parution_debut"])
        ) {
            $m = Model::getModel();
            $in_database = $m->getJeuParId($_POST["id_jeu"]) !== false;
        }

        if ($in_database) {
            // Préparation des données pour la mise à jour
            $infos = [
                'id_jeu' => $_POST['id_jeu'],
                'titre_jeu' => $_POST['titre_jeu'],
                'date_parution_debut' => $_POST['date_parution_debut'],
                'date_parution_fin' => $_POST['date_parution_fin'],
                'information_date' => $_POST['information_date'],
                'version' => $_POST['version'],
                'nombre_joueurs' => $_POST['nombre_joueurs'],
                'age_min' => $_POST['age_min'],
                'mots_cles' => $_POST['mots_cles'],
            ];

            // Appel de la méthode update
            $m->updateInfosJeu($infos);

            $message = "Le jeu a bien été mis à jour.";
        } else {
            $message = "Il n'y a pas de jeu à mettre à jour avec cet ID.";
        }

        // Affichage du message de confirmation
        $data = [
            "title" => "Mise à jour du jeu",
            "message" => $message,
        ];
        $this->render("message", $data);
    }


}
