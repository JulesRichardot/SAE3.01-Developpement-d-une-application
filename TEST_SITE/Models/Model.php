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
        require_once 'identifiants/identifiant.php';

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
    public static function getModel()
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

    public function getJeuParId($id)
    {
        $req = $this->bd->prepare('SELECT * FROM jeu WHERE id_jeu = :id_jeu');
        $req->bindParam(':id_jeu', $id, PDO::PARAM_INT);
        $req->execute();
        $tab = $req->fetchAll(PDO::FETCH_ASSOC);
        return $tab[0];
    }

    public function getJeuxWithLimit($offset = 0, $limit = 25)
    {
        $requete = $this->bd->prepare('Select * from jeu WHERE date_parution_debut IS NOT NULL ORDER BY date_parution_debut DESC LIMIT :limit OFFSET :offset');
        $requete->bindValue(':limit', $limit, PDO::PARAM_INT);
        $requete->bindValue(':offset', $offset, PDO::PARAM_INT);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    // Fonction pour récupérer un jeu aléatoire
    public function getJeuAleatoire() {
        $req = $this->bd->prepare('SELECT * FROM jeu ORDER BY RAND() LIMIT 1');
        $req->execute();
        return $req->fetch(PDO::FETCH_ASSOC);
    }

    public function getLast25()
    {
        $req = $this->bd->prepare('SELECT titre, date_parution_debut, mots_cles FROM jeu WHERE date_parution_debut IS NOT NULL ORDER BY date_parution_debut ASC LIMIT 25;');
        $req->execute();
        return $req->fetchall();
    }

    public function getTop10JeuxEmpruntes()
{
    // SQL pour récupérer les 25 jeux les plus empruntés
    $query = "
        SELECT jeu.id_jeu, jeu.titre, COUNT(pret.id_pret) AS nombre_emprunts
        FROM jeu
        LEFT JOIN pret ON jeu.id_jeu = pret.id_boite
        GROUP BY jeu.id_jeu
        ORDER BY nombre_emprunts DESC
        LIMIT 10
    ";
    
    $req = $this->bd->prepare($query);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

}

?>