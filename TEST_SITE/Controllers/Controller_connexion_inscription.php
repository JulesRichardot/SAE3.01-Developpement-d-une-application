<?php

class Controller_connexion_inscription extends Controller
{
    /**
     * Action par défaut : afficher la page de connexion/inscription.
     */
    public function action_default()
    {
        $this->action_afficher();
    }

    /**
     * Affiche la page de connexion/inscription.
     */
    public function action_afficher()
    {
        $data = [
            'erreur' => $_GET['erreur'] ?? '', // Message d'erreur 
            'succes' => $_GET['succes'] ?? '', // Message de succès 
        ];
        $this->render("connexion_inscription", $data);
    }

    /**
     * Gère la soumission du formulaire de connexion.
     */
    public function action_connexion()
    {
        $email = $_POST['email'] ?? '';
        $motDePasse = $_POST['mot_de_passe'] ?? '';

        // Vérifie les champs vides
        if (empty($email) || empty($motDePasse)) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur_connexion=Veuillez remplir tous les champs.&connexion_email=' . urlencode($email));
            exit;
        }

        // Vérifie que l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur_connexion=Email invalide.&connexion_email=' . urlencode($email));
            exit;
        }

        // Récupération de l'utilisateur via le modèle
        $modele = Model::getModel();
        $utilisateur = $modele->getUtilisateurParMail($email);

        if ($utilisateur) {
            // Vérification du mot de passe
            if (password_verify($motDePasse, $utilisateur['mot_de_passe'])) {
                session_start();
                $_SESSION['utilisateur'] = [
                    'id' => $utilisateur['utilisateur_id'],
                    'nom' => $utilisateur['nom'],
                    'email' => $utilisateur['email'],
                    'role' => $utilisateur['role']
                ]; // Stockage des données utilisateur dans la session
                header('Location: index.php?controller=home'); // Redirection vers la page d'accueil
                exit;
            } else {
                // Si le mot de passe est incorrect
                header('Location: index.php?controller=connexion_inscription&action=afficher&erreur_connexion=Mot de passe incorrect.&connexion_email=' . urlencode($email));
                exit;
            }
        } else {
            // Si l'email n'existe pas
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur_connexion=Email incorrect.&connexion_email=' . urlencode($email));
            exit;
        }
    }


    /**
     * Gère la soumission du formulaire d'inscription.
     */
    public function action_inscription()
    {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $motDePasse = $_POST['mot_de_passe'] ?? '';
        $telephone = $_POST['telephone'] ?? null;
        $adresse = $_POST['adresse'] ?? null;
        $date_naissance = $_POST['date_naissance'] ?? null;

        // Vérifie les champs obligatoires
        if (empty($nom) || empty($email) || empty($motDePasse)) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur_inscription=Veuillez remplir tous les champs obligatoires.');
            exit;
        }

        // Vérifie que l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur_inscription=Email invalide.');
            exit;
        }

        // Vérifie que le mot de passe respecte les exigences de sécurité
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $motDePasse)) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur_inscription=Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.');
            exit;
        }

        // Vérifie si l'utilisateur existe déjà
        $modele = Model::getModel();
        $utilisateurExistant = $modele->getUtilisateurParMail($email);

        if ($utilisateurExistant) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur_inscription=Email déjà utilisé.');
            exit;
        }

        // Hachage du mot de passe
        $motDePasseHash = password_hash($motDePasse, PASSWORD_BCRYPT);

        // Création de l'utilisateur avec informations complémentaires
        $modele->ajouterUtilisateur($nom, $email, $motDePasseHash, $telephone, $adresse, $date_naissance);

        // Redirection avec message de succès
        header('Location: index.php?controller=connexion_inscription&action=afficher&succes=Inscription réussie.');
        exit;
    }



    public function action_deconnexion()
    {
        // Supprime toutes les données de la session
        session_destroy();

        // Redirige vers la page d'accueil
        header('Location: index.php?controller=home');
        exit;
    }

}
