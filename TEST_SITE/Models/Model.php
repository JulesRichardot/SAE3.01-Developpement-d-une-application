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
        $query = "SELECT jeu.*, auteur.nom as nom_auteur, editeur.nom as nom_editeur, mecanisme.nom as nom_mecanisme FROM jeu Left JOIN jeu_auteur USING(id_jeu) Left JOIN auteur USING(auteur_id) Left join jeu_editeur on jeu_editeur.id_jeu = jeu.id_jeu Left JOIN editeur on editeur.editeur_id = jeu_editeur.editeur_id Left join mecanisme on jeu.mecanisme_id = mecanisme.mecanisme_id WHERE jeu.id_jeu=:id_jeu";
        $req = $this->bd->prepare($query);
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

    public function getNbBoite($id_jeu){
    $query = "SELECT count(*) as nb_boite from boite join jeu On boite.jeu_id = jeu.id_jeu where boite.jeu_id = $id_jeu and jeu.id_jeu = $id_jeu; ";
    $req = $this->bd->prepare($query);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
}

    public function getUtilisateurParMail($email)
{
    $sql = "SELECT * FROM utilisateur WHERE email = :email";
    $stmt = $this->bd->prepare($sql);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
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

public function getJeuSimilaire($id_jeu){
    $query = "SELECT mecanisme_id FROM jeu WHERE id_jeu = :id_jeu";
    $req = $this->bd->prepare($query);
    $req->bindParam(':id_jeu', $id_jeu, PDO::PARAM_INT); // Utilisation de la bonne variable
    $req->execute();
    $tab = $req->fetch(PDO::FETCH_ASSOC);

    if ($tab === false) {
        return ["mecanisme_id" => "Inconnue"];
    }
    else {
        $meca = $tab["mecanisme_id"];
        $query = "SELECT * FROM jeu WHERE mecanisme_id = :meca ORDER BY RAND() LIMIT 3";
        $req = $this->bd->prepare($query);
        $req->bindParam(':meca', $meca, PDO::PARAM_INT); // Utilisation de la requête préparée
        $req->execute();
        $tab = $req->fetchAll(PDO::FETCH_ASSOC);
        return $tab;
    }
}

public function getJeuParTitre($unTitre){
    $req = $this->bd->prepare("SELECT * from jeu where titre = :unTitre");
    $req->bindValue(':unTitre', $unTitre, PDO::PARAM_STR);
    $req->execute();
    $tab = $req->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}

public function getCategories(){
    $req = $this->bd->prepare("SELECT nom as nom_categorie from categorie");
    $req->execute();
    $tab = $req->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}

public function getNbJoueurs(){
    $req = $this->bd->prepare("SELECT DISTINCT nombre_de_joueurs from jeu");
    $req->execute();
    $tab = $req->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
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


public function getDateDeSortie(){
    $req = $this->bd->prepare("SELECT DISTINCT date_parution_debut as date_sortie from jeu");
    $req->execute();
    $tab = $req->fetchAll(PDO::FETCH_ASSOC);
    return $tab;
}


public function ajouterUtilisateur($nom, $email, $motDePasse, $telephone = null, $adresse = null, $dateNaissance = null)
{
    // Insertion dans la table utilisateur
    $sqlUtilisateur = "INSERT INTO utilisateur (nom, email, mot_de_passe, role) VALUES (:nom, :email, :mot_de_passe, 'Utilisateur')";
    $stmtUtilisateur = $this->bd->prepare($sqlUtilisateur);
    $stmtUtilisateur->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':mot_de_passe' => $motDePasse
    ]);

    // Récupérer l'ID de l'utilisateur crée
    $utilisateurId = $this->bd->lastInsertId();

    // Insertion dans la table emprunteur
    $sqlEmprunteur = "INSERT INTO emprunteur (emprunteur_id, telephone, adresse, date_naissance) VALUES (:emprunteur_id, :telephone, :adresse, :date_naissance)";
    $stmtEmprunteur = $this->bd->prepare($sqlEmprunteur);
    $stmtEmprunteur->execute([
        ':emprunteur_id' => $utilisateurId,
        ':telephone' => $telephone,
        ':adresse' => $adresse,
        ':date_naissance' => $dateNaissance
    ]);
}



public function updateInfoGeneral($utilisateurId, $nom, $email)
{
    // Vérifie si l'email est déjà utilisé par un autre utilisateur
    $sqlCheck = "SELECT utilisateur_id FROM utilisateur WHERE email = :email AND utilisateur_id != :utilisateur_id";
    $stmtCheck = $this->bd->prepare($sqlCheck);
    $stmtCheck->execute([
        ':email' => $email,
        ':utilisateur_id' => $utilisateurId
    ]);

    if ($stmtCheck->fetch()) {
        throw new Exception("Email déjà utilisé par un autre utilisateur.");
    }

    // Met à jour les informations générales
    $sqlUpdate = "UPDATE utilisateur SET nom = :nom, email = :email WHERE utilisateur_id = :utilisateur_id";
    $stmtUpdate = $this->bd->prepare($sqlUpdate);
    $stmtUpdate->execute([
        ':nom' => $nom,
        ':email' => $email,
        ':utilisateur_id' => $utilisateurId
    ]);
}


public function updateInfoComplementaire($utilisateurId, $telephone, $adresse, $dateNaissance)
{
    // Vérifie si l'utilisateur est déjà dans la table emprunteur
    $sqlCheck = "SELECT COUNT(*) FROM emprunteur WHERE emprunteur_id = :utilisateur_id";
    $stmtCheck = $this->bd->prepare($sqlCheck);
    $stmtCheck->execute([':utilisateur_id' => $utilisateurId]);
    $exists = $stmtCheck->fetchColumn();

    if ($exists) {
        // Mise à jour des informations complémentaires
        $sqlUpdate = "UPDATE emprunteur 
                      SET telephone = :telephone, adresse = :adresse, date_naissance = :date_naissance 
                      WHERE emprunteur_id = :utilisateur_id";
        $stmtUpdate = $this->bd->prepare($sqlUpdate);
        $stmtUpdate->execute([
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':date_naissance' => $dateNaissance,
            ':utilisateur_id' => $utilisateurId
        ]);
    } else {
        // Insertion des informations complémentaires
        $sqlInsert = "INSERT INTO emprunteur (emprunteur_id, telephone, adresse, date_naissance) 
                      VALUES (:utilisateur_id, :telephone, :adresse, :date_naissance)";
        $stmtInsert = $this->bd->prepare($sqlInsert);
        $stmtInsert->execute([
            ':utilisateur_id' => $utilisateurId,
            ':telephone' => $telephone,
            ':adresse' => $adresse,
            ':date_naissance' => $dateNaissance
        ]);
    }
}

public function getInfoComplementaire($utilisateurId)
{
    $sql = "SELECT telephone, adresse, date_naissance FROM emprunteur WHERE emprunteur_id = :utilisateur_id";
    $stmt = $this->bd->prepare($sql);
    $stmt->execute([':utilisateur_id' => $utilisateurId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result : []; // Retourne un tableau vide si aucune donnée n'est trouvée
}


public function getUtilisateurs() {
    $query = "SELECT id_utilisateur, nom, email FROM utilisateur";
    $req = $this->bd->prepare($query);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

public function getReservations() {
    $query = "SELECT reservation.id_reservation, jeu.nom AS nom_jeu, utilisateur.nom AS utilisateur, 
                     reservation.date_reservation, reservation.statut 
              FROM reservation
              INNER JOIN jeu ON reservation.jeu_id = jeu.id_jeu
              INNER JOIN utilisateur ON reservation.utilisateur_id = utilisateur.id_utilisateur";
    $req = $this->bd->prepare($query);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}

// Méthode pour récupérer tous les jeux
public function getJeux() {
    $query = "SELECT id_jeu, nom, categorie FROM jeu";
    $req = $this->bd->prepare($query);
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}



}

?>
