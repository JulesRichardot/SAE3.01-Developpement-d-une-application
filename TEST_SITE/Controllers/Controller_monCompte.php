<?php

class Controller_monCompte extends Controller
{
    /**
     * Action par défaut : affiche la page "Mon Compte".
     */
    public function action_default()
    {
        $this->action_afficher();
    }

    /**
     * Affiche les informations du compte utilisateur.
     */
    public function action_afficher()
    {
        // Vérifie si l'utilisateur est connecté
        if (!isset($_SESSION['utilisateur'])) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur_connexion=Veuillez vous connecter.');
            exit;
        }

        // Récupère les informations de l'utilisateur
        $utilisateur = $_SESSION['utilisateur'];

        // Charge la vue avec les données de l'utilisateur
        $this->render("monCompte", [
            'utilisateur' => $utilisateur
        ]);
    }
}
