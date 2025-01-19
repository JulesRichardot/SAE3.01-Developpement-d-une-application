<?php 

class Controller_administration extends Controller {

    public function action_default()
    {
        $this->action_administration();
    }
    
    public function action_administration() {
        if (!isset($_SESSION['utilisateur'])) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur=Veuillez vous connecter.');
            exit;
        }
        $role = $_SESSION['utilisateur']['role'];
        if ($role !== 'Admin' && $role !== 'Gestionnaire') {
            header('Location: index.php');
            exit;
        }

        $model = Model::getModel();

        if ($role === 'Admin') {
            $data = [
                'jeux' => $model->getJeux(),
                'utilisateurs' => $model->getUtilisateurs(),
                'reservations' => $model->getReservations(),
                'role' => $role
            ];
        } elseif ($role === 'Gestionnaire') {
            $data['jeux'] = $model->getJeux();
            $data['reservations'] = $model->getReservations();
        }

        $this->render("administration", $data);
    }   

    public function action_administrationUtilisateur() {
        // Vérification du rôle
        if (!isset($_SESSION['utilisateur'])) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur=Veuillez vous connecter.');
            exit;
        }
        $role = $_SESSION['utilisateur']['role'];
        if ($role !== 'Admin' && $role !== 'Gestionnaire') {
            header('Location: index.php');
            exit;
        }

        $model = Model::getModel();
        // Récupération des données et render
        if ($role === 'Admin') {
            $data = [
                'jeux' => $model->getJeux(),
                'utilisateurs' => $model->getUtilisateurs(),
                'reservations' => $model->getReservations(),
                'role' => $role
            ];
        }
        $this->render("administrationUtilisateur", $data);

    }

    public function action_administrationReservation() {
        // Vérification du rôle
        if (!isset($_SESSION['utilisateur'])) {
            header('Location: index.php?controller=connexion_inscription&action=afficher&erreur=Veuillez vous connecter.');
            exit;
        }
        $role = $_SESSION['utilisateur']['role'];
        if ($role !== 'Admin' && $role !== 'Gestionnaire') {
            header('Location: index.php');
            exit;
        }

        $model = Model::getModel();
        // Récupération des données et render
        if ($role === 'Gestionnaire' || $role === 'Admin' ) {
            $data = [
                'jeux' => $model->getJeux(),
                'reservations' => $model->getReservations(),
                'role' => $role
            ];
        }

        $this->render("administrationReservation", $data);
    }
}
