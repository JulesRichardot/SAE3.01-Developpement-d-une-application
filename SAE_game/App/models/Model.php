<?php

class Model
{
    private $bd; // Connexion à la base de données
    private static $instance = null; // Instance unique de la classe

    /**
     * Constructeur privé
     * 
     * Configure la connexion à la base de données (DSN, utilisateur, mot de passe).
     */
    private function __construct()
    {
        $dsn = 'mysql:dbname=nom_de_la_base;host=localhost'; //nom bd
        $username = 'votre_utilisateur'; // Ajoutez votre utilisateur
        $password = 'votre_mot_de_passe'; // Ajoutez votre mot de passe

        try {
            // Tentative de connexion à la base de données
            $this->bd = new PDO($dsn, $username, $password);

            // Configure PDO pour afficher des exceptions en cas d'erreur
            $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Définit l'encodage UTF-8 pour la connexion
            $this->bd->query("SET NAMES 'utf8'");
        } catch (PDOException $e) {
            // Si la connexion échoue, affiche un message d'erreur et termine le script
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }


    /**
     * Retourne l'instance unique de la classe.
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Model();
        }
        return self::$instance;
    }
  

    public function getNbJeux()
    {
        $req = $this->bd->prepare('SELECT COUNT(*) FROM jeu');
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_NUM);
        return $tab[0];
    }

    public function getJeu($name)
    {
        $req = $this->bd->prepare('SELECT * FROM jeu WHERE titre = :name');
        $req->bindParam(':name', $name, PDO::PARAM_STR);
        $req->execute();
        $tab = $req->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }

        public function getNbExemplaire($jeux)
    {
        $req = $this->bd->prepare('SELECT COUNT(*) FROM boite WHERE jeu_id = :jeux');
        $req->bindParam(':jeux', $jeux, PDO::PARAM_INT);
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_NUM);
        return $tab[0];
    }
    public function getJeuxPop()
    {
        // Assurez-vous que la table 'Jeux' contient une colonne 'popularite'
        $req = $this->bd->prepare('SELECT * FROM jeu ORDER BY popularite DESC LIMIT 10');
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getJeuParCategorie($categorie)
      {
        $req = $this->bd->prepare('
            SELECT j.* 
            FROM jeu j
            JOIN jeu_categorie jc ON j.id_jeu = jc.id_jeu
            JOIN categorie c ON jc.id_categorie = c.id_categorie
            WHERE c.nom = :categorie
        ');
        $req->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBoitesDisponibles($id_jeu) {
    $query = "SELECT boite.id_boite, boite.etat, localisation.salle, localisation.etagere 
              FROM boite 
              INNER JOIN localisation ON boite.localisation_id = localisation.localisation_id 
              WHERE boite.jeu_id = :id_jeu";

    $req = $this->bd->prepare($query);
    $req->bindValue(":id_jeu", $id_jeu, PDO::PARAM_INT);
    $req->execute();
    
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

    public function getJeuParId($id)
    {
        $req = $this->bd->prepare('SELECT * FROM jeu WHERE titre = :id');
        $req->bindParam(':id_jeu', $id, PDO::PARAM_INT);
        $req->execute();
        $tab = $req->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }
    
    public function getToutesLesBoitesJeu($id_jeu)
    {
        $req = $this->bd->prepare('SELECT * FROM boite WHERE jeu_id = :id_jeu');
        $req->bindParam(':id_jeu', $id_jeu, PDO::PARAM_INT);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getBoiteAttributSpecifique($id_boite)
    {
        $req = $this->bd->prepare('SELECT * FROM boite WHERE id_boite = :id_boite');
        $req->bindParam(':id_boite', $id_boite, PDO::PARAM_INT);
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function searchJeux($keyword) {
    // Recherche dans le titre et les mots clés (mots_cles)
    $req = $this->bd->prepare('
        SELECT * FROM jeu
        WHERE titre LIKE :keyword 
        OR mots_cles LIKE :keyword
    ');

    // Préparer le mot-clé avec les % pour la recherche partielle
    $likeKeyword = '%' . $keyword . '%';

    $req->bindParam(':keyword', $likeKeyword, PDO::PARAM_STR);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

    // Fonction pour récupérer un jeu aléatoire
    public function getJeuAleatoire() {
        $req = $this->bd->prepare('SELECT * FROM jeu ORDER BY RAND() LIMIT 1');
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }
}
?>
