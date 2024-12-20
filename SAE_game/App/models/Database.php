<?php

/**
 * Classe Model
 * 
 * Gère la connexion à la base de données avec le design pattern Singleton.
 */
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
        $dsn = ''; // Ajouter le DSN (exemple : 'mysql:dbname=;host=')
        $username = ''; // Ajouter le nom d'utilisateur
        $password = ''; // Ajouter le mot de passe

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

     public function getNbJeux(){
        $req = $this->bd->prepare('SELECT COUNT(*) FROM Jeux');
        $req->execute();
        $tab = $req->fetch(PDO::FETCH_NUM);
        return $tab[0];
    }

    public function getJeu($name){
        $req = $this->bd->prepare('SELECT * FROM Jeux WHERE titre = '. $name );
        $req->execute();
        $tab = $req->fetchall(PDO::FETCH_ASSOC);
        return $tab
    }

    public function getNbExemplaire($jeux){
        $req = $this->bd->prepare();
        $req->execute();
        return
    }

    public function getJeuParCategorie($categorie){}

    public function getToutesLesBoitesJeu($jeu){}

    public function getBoiteAttributSpecifique($attribut){}

?>


?>
