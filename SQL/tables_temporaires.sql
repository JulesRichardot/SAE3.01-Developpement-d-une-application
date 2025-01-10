-- Création des tables

CREATE TABLE Utilisateur (
    utilisateur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'Gestionnaire', 'Utilisateur') NOT NULL
);

CREATE TABLE Emprunteur (
    emprunteur_id INT PRIMARY KEY,
    adresse TEXT NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    FOREIGN KEY (emprunteur_id) REFERENCES Utilisateur(utilisateur_id)
);

CREATE TABLE Mecanisme (
    mecanisme_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Localisation (
    localisation_id INT AUTO_INCREMENT PRIMARY KEY,
    salle VARCHAR(50) NOT NULL,
    etagere VARCHAR(50) NOT NULL
);

CREATE TABLE Collection (
    collection_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Editeur (
    editeur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Auteur (
    auteur_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Categorie (
    categorie_id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Jeu (
    jeu_id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    date_publication DATE,
    nb_joueurs_min INT,
    nb_joueurs_max INT,
    age_minimum INT,
    mecanisme_id INT,
    FOREIGN KEY (mecanisme_id) REFERENCES Mecanisme(mecanisme_id)
);

CREATE TABLE Boite (
    boite_id INT AUTO_INCREMENT PRIMARY KEY,
    jeu_id INT NOT NULL,
    etat VARCHAR(50) NOT NULL,
    localisation_id INT NOT NULL,
    code_barre VARCHAR(50),
    collection_id INT,
    FOREIGN KEY (jeu_id) REFERENCES Jeu(jeu_id),
    FOREIGN KEY (localisation_id) REFERENCES Localisation(localisation_id),
    FOREIGN KEY (collection_id) REFERENCES Collection(collection_id)
);

CREATE TABLE Pret (
    pret_id INT AUTO_INCREMENT PRIMARY KEY,
    emprunteur_id INT NOT NULL,
    boite_id INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE,
    FOREIGN KEY (emprunteur_id) REFERENCES Emprunteur(emprunteur_id),
    FOREIGN KEY (boite_id) REFERENCES Boite(boite_id)
);

CREATE TABLE Jeu_Categorie (
    jeu_id INT NOT NULL,
    categorie_id INT NOT NULL,
    PRIMARY KEY (jeu_id, categorie_id),
    FOREIGN KEY (jeu_id) REFERENCES Jeu(jeu_id),
    FOREIGN KEY (categorie_id) REFERENCES Categorie(categorie_id)
);

CREATE TABLE Jeu_Auteur (
    jeu_id INT NOT NULL,
    auteur_id INT NOT NULL,
    PRIMARY KEY (jeu_id, auteur_id),
    FOREIGN KEY (jeu_id) REFERENCES Jeu(jeu_id),
    FOREIGN KEY (auteur_id) REFERENCES Auteur(auteur_id)
);

CREATE TABLE Jeu_Editeur (
    jeu_id INT NOT NULL,
    editeur_id INT NOT NULL,
    PRIMARY KEY (jeu_id, editeur_id),
    FOREIGN KEY (jeu_id) REFERENCES Jeu(jeu_id),
    FOREIGN KEY (editeur_id) REFERENCES Editeur(editeur_id)
);
