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
            'erreur' => $_GET['erreur'] ?? '', // Message d'erreur éventuel
            'succes' => $_GET['succes'] ?? '', // Message de succès éventuel
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
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur=Veuillez remplir tous les champs.');
            exit;
        }

        // Vérifie que l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur=Email invalide.');
            exit;
        }

        // Récupération de l'utilisateur via le modèle
        $modele = Model::getModel();
        $utilisateur = $modele->getUtilisateurParMail($email);

        // Vérification du mot de passe
        if ($utilisateur && password_verify($motDePasse, $utilisateur['mot_de_passe'])) {
            $_SESSION['utilisateur'] = [
                'id' => $utilisateur['utilisateur_id'],
                'nom' => $utilisateur['nom'],
                'email' => $utilisateur['email'],
                'role' => $utilisateur['role']
            ]; // Stockage des données utilisateur dans la session
            header('Location: index.php?controller=home'); // Redirection vers la page d'accueil
            exit;
        }

        // En cas d'échec
        header('Location: index.php?controller=connexion_inscription&action=afficher&erreur=Identifiants incorrects.');
        exit;
    }

    /**
     * Gère la soumission du formulaire d'inscription.
     */
    public function action_inscription()
    {
        $nom = $_POST['nom'] ?? '';
        $email = $_POST['email'] ?? '';
        $motDePasse = $_POST['mot_de_passe'] ?? '';

        // Vérifie les champs vides
        if (empty($nom) || empty($email) || empty($motDePasse)) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur=Veuillez remplir tous les champs.');
            exit;
        }

        // Vérifie que l'email est valide
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur=Email invalide.');
            exit;
        }

        // Vérifie si l'utilisateur existe déjà
        $modele = Model::getModel();
        $utilisateurExistant = $modele->getUtilisateurParMail($email);

        if ($utilisateurExistant) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur=Email déjà utilisé.');
            exit;
        }

        // Hashage du mot de passe
        $motDePasseHash = password_hash($motDePasse, PASSWORD_BCRYPT);

        // Création de l'utilisateur
        $modele->ajouterUtilisateur($nom, $email, $motDePasseHash);

        // Redirection avec message de succès
        header('Location: index.php?controller=connexion_inscription&action=afficher&succes=Inscription réussie.');
        exit;
    }
}
