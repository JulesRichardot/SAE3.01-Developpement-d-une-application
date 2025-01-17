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

        // Récupère les informations générales
        $utilisateur = $_SESSION['utilisateur'];

        // Récupère les informations complémentaires
        $modele = Model::getModel();
        $infoComplementaire = $modele->getInfoComplementaire($utilisateur['id']);

        // Fusionne les informations générales et complémentaires
        $data = array_merge($utilisateur, $infoComplementaire);

        // Charge la vue avec les données de l'utilisateur
        $this->render("monCompte", [
            'utilisateur' => $data
        ]);
    }



    public function action_updateGenerale()
    {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';

        // Vérifications
        if (empty($nom) || empty($email)) {
            header('Location: index.php?controller=monCompte&action=afficher&erreur_email=Tous les champs doivent être remplis.');
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?controller=monCompte&action=afficher&erreur_email=Email invalide.');
            exit;
        }

        $modele = Model::getModel();

        try {
            $modele->updateInfoGeneral($_SESSION['utilisateur']['id'], $nom, $email);

            // Met à jour la session
            $_SESSION['utilisateur']['nom'] = $nom;
            $_SESSION['utilisateur']['email'] = $email;

            header('Location: index.php?controller=monCompte&action=afficher&succes=Informations générales mises à jour.');
            exit;
        } catch (Exception $e) {
            // Si une erreur survient, renvoyer un message spécifique
            header('Location: index.php?controller=monCompte&action=afficher&erreur_email=' . urlencode($e->getMessage()));
            exit;
        }
    }



    public function action_updateComplementaire()
    {
        $telephone = $_POST['telephone'] ?? null;
        $adresse = $_POST['adresse'] ?? null;
        $dateNaissance = $_POST['date_naissance'] ?? null;

        $modele = Model::getModel();
        $modele->updateInfoComplementaire($_SESSION['utilisateur']['id'], $telephone, $adresse, $dateNaissance);

        header('Location: index.php?controller=monCompte&action=afficher&succes=Informations complémentaires mises à jour.');
        exit;
    }
}
