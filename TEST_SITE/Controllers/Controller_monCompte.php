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
        if (!isset($_SESSION['utilisateur'])) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur_connexion=Veuillez vous connecter.');
            exit;
        }

        $utilisateur = $_SESSION['utilisateur'];
        $modele = Model::getModel();
        $infoComplementaire = $modele->getInfoComplementaire($utilisateur['id']);
        $data = array_merge($utilisateur, $infoComplementaire);

        // Ajout des messages d'erreur ou de succès
        $this->render("monCompte", [
            'utilisateur' => $data,
            'erreur' => $_GET['erreur'] ?? '', // Récupère l'erreur dans l'URL
            'succes' => $_GET['succes'] ?? '' // Récupère le succès dans l'URL
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

        // Validation du numéro de téléphone
        if ($telephone && !preg_match('/^\+?[0-9 ]{8,20}$/', $telephone)) {
            header('Location: index.php?controller=monCompte&action=afficher&erreur=Numéro de téléphone invalide.');
            exit;
        }

        // Validation de la date de naissance
        if ($dateNaissance) {
            $dateTimestamp = strtotime($dateNaissance);
            $dateMin = strtotime('1900-01-01');
            $dateNow = time();

            if ($dateTimestamp < $dateMin || $dateTimestamp > $dateNow) {
                header('Location: index.php?controller=monCompte&action=afficher&erreur=Date de naissance invalide.');
                exit;
            }
        }

        // Mise à jour via le modèle
        $modele = Model::getModel();
        $modele->updateInfoComplementaire($_SESSION['utilisateur']['id'], $telephone, $adresse, $dateNaissance);

        header('Location: index.php?controller=monCompte&action=afficher&succes=Informations complémentaires mises à jour.');
        exit;
    }

    public function action_updatePassword()
    {
        $ancienMotDePasse = $_POST['ancien_mot_de_passe'] ?? '';
        $nouveauMotDePasse = $_POST['nouveau_mot_de_passe'] ?? '';
        $confirmationMotDePasse = $_POST['confirmation_mot_de_passe'] ?? '';

        // Vérifie que tous les champs nécessaires sont remplis
        if (empty($ancienMotDePasse) || empty($nouveauMotDePasse) || empty($confirmationMotDePasse)) {
            header('Location: index.php?controller=monCompte&action=afficher&erreur=Tous les champs doivent être remplis pour changer le mot de passe.');
            exit;
        }

        // Vérifie que le nouveau mot de passe correspond à la confirmation
        if ($nouveauMotDePasse !== $confirmationMotDePasse) {
            header('Location: index.php?controller=monCompte&action=afficher&erreur=Les nouveaux mots de passe ne correspondent pas.');
            exit;
        }


        // Vérifie que le mot de passe respecte les exigences
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $nouveauMotDePasse)) {
            header('Location: index.php?controller=monCompte&action=afficher&erreur=Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.');
            exit;
        }

        // Met à jour le mot de passe via le modèle
        try {
            $modele = Model::getModel();
            $modele->updatePassword($_SESSION['utilisateur']['id'], $ancienMotDePasse, $nouveauMotDePasse);
            header('Location: index.php?controller=monCompte&action=afficher&succes=Mot de passe mis à jour avec succès.');
        } catch (Exception $e) {
            header('Location: index.php?controller=monCompte&action=afficher&erreur=' . urlencode($e->getMessage()));
        }
        exit;
    }



}
?>
