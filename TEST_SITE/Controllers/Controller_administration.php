<?php 

class Controller_administration extends Controller {

    public function action_default()
    {
        $this->action_administration();
    }
    
    public function action_administration() {
        echo "sdnsdv";
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
    $data = ['role' => $role];

    if ($role === 'Admin') {
        $data['jeux'] = $model->getJeux();
        $data['utilisateurs'] = $model->getUtilisateurs();
        $data['reservations'] = $model->getReservations();
    } elseif ($role === 'Gestionnaire') {
        $data['jeux'] = $model->getJeux();
        $data['reservations'] = $model->getReservations();
    }

    $this->render("administration", $data);
}   
}

?>
