-- Désactiver temporairement les vérifications des clés étrangères
SET FOREIGN_KEY_CHECKS = 0;

-- Supprimer les tables existantes
DROP TABLE IF EXISTS jeu_categorie;
DROP TABLE IF EXISTS jeu_auteur;
DROP TABLE IF EXISTS jeu_editeur;
DROP TABLE IF EXISTS pret;
DROP TABLE IF EXISTS boite;
DROP TABLE IF EXISTS jeu;
DROP TABLE IF EXISTS emprunteur;
DROP TABLE IF EXISTS utilisateur;
DROP TABLE IF EXISTS localisation;
DROP TABLE IF EXISTS collection;
DROP TABLE IF EXISTS mecanisme;
DROP TABLE IF EXISTS editeur;
DROP TABLE IF EXISTS auteur;
DROP TABLE IF EXISTS categorie;

-- Réactiver les vérifications des clés étrangères
SET FOREIGN_KEY_CHECKS = 1;

-- Création des tables

CREATE TABLE utilisateur (
    utilisateur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'Gestionnaire', 'Utilisateur') NOT NULL
);

CREATE TABLE emprunteur (
    emprunteur_id INT PRIMARY KEY,
    adresse TEXT NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    FOREIGN KEY (emprunteur_id) REFERENCES utilisateur(utilisateur_id)
);

CREATE TABLE mecanisme (
    mecanisme_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE localisation (
    localisation_id INT AUTO_INCREMENT PRIMARY KEY,
    salle VARCHAR(50) NOT NULL,
    etagere VARCHAR(50) NOT NULL
);

CREATE TABLE collection (
    collection_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE editeur (
    editeur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE auteur (
    auteur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE categorie (
    id_categorie INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE jeu (
    id_jeu INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    date_publication DATE,
    nb_joueurs_min INT,
    nb_joueurs_max INT,
    age_minimum INT,
    mecanisme_id INT,
    FOREIGN KEY (mecanisme_id) REFERENCES mecanisme(mecanisme_id)
);

CREATE TABLE boite (
    id_boite INT AUTO_INCREMENT PRIMARY KEY,
    jeu_id INT NOT NULL,
    etat VARCHAR(50) NOT NULL,
    localisation_id INT NOT NULL,
    code_barre VARCHAR(50),
    collection_id INT,
    FOREIGN KEY (jeu_id) REFERENCES jeu(id_jeu),
    FOREIGN KEY (localisation_id) REFERENCES localisation(localisation_id),
    FOREIGN KEY (collection_id) REFERENCES collection(collection_id)
);

CREATE TABLE pret (
    id_pret INT AUTO_INCREMENT PRIMARY KEY,
    emprunteur_id INT NOT NULL,
    id_boite INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE,
    FOREIGN KEY (emprunteur_id) REFERENCES emprunteur(emprunteur_id),
    FOREIGN KEY (id_boite) REFERENCES boite(id_boite)
);

CREATE TABLE jeu_categorie (
    id_jeu INT NOT NULL,
    id_categorie INT NOT NULL,
    PRIMARY KEY (id_jeu, id_categorie),
    FOREIGN KEY (id_jeu) REFERENCES jeu(id_jeu),
    FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie)
);

CREATE TABLE jeu_auteur (
    id_jeu INT NOT NULL,
    auteur_id INT NOT NULL,
    PRIMARY KEY (id_jeu, auteur_id),
    FOREIGN KEY (id_jeu) REFERENCES jeu(id_jeu),
    FOREIGN KEY (auteur_id) REFERENCES auteur(auteur_id)
);

CREATE TABLE jeu_editeur (
    id_jeu INT NOT NULL,
    editeur_id INT NOT NULL,
    PRIMARY KEY (id_jeu, editeur_id),
    FOREIGN KEY (id_jeu) REFERENCES jeu(id_jeu),
    FOREIGN KEY (editeur_id) REFERENCES editeur(editeur_id)
);
