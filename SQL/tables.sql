CREATE TABLE Jeux (
    jeu_id INT PRIMARY KEY,
    titre VARCHAR(255),
    date_parution_debut YEAR,
    date_parution_fin YEAR,
    information_date VARCHAR(255),
    version VARCHAR(255),
    nombre_de_joueurs VARCHAR(255),
    age_indique VARCHAR(255),
    mots_cles TEXT,
    mecanisme_id INT,
    FOREIGN KEY (mecanisme_id) REFERENCES Mecanismes(mecanisme_id)
);

CREATE TABLE Boites (
    boite_id INT PRIMARY KEY,
    jeu_id INT,
    etat VARCHAR(255),
    localisation_id INT,
    code_barre VARCHAR(255),
    collection_id INT,
    FOREIGN KEY (jeu_id) REFERENCES Jeux(jeu_id),
    FOREIGN KEY (localisation_id) REFERENCES Localisations(localisation_id),
    FOREIGN KEY (collection_id) REFERENCES Collections(collection_id)
);

CREATE TABLE Auteurs (
    auteur_id INT PRIMARY KEY,
    nom VARCHAR(255)
);

CREATE TABLE Editeurs (
    editeur_id INT PRIMARY KEY,
    nom VARCHAR(255)
);

CREATE TABLE Categories (
    categorie_id INT PRIMARY KEY,
    nom VARCHAR(255)
);

CREATE TABLE Localisations (
    localisation_id INT PRIMARY KEY,
    salle VARCHAR(255),
    etagere VARCHAR(255)
);

CREATE TABLE Collections (
    collection_id INT PRIMARY KEY,
    nom VARCHAR(255)
);

CREATE TABLE Mecanismes (
    mecanisme_id INT PRIMARY KEY,
    nom VARCHAR(255)
);
CREATE TABLE Jeu_Auteur (
    jeu_id INT,
    auteur_id INT,
    PRIMARY KEY (jeu_id, auteur_id),
    FOREIGN KEY (jeu_id) REFERENCES Jeux(jeu_id),
    FOREIGN KEY (auteur_id) REFERENCES Auteurs(auteur_id)
);

CREATE TABLE Jeu_Editeur (
    jeu_id INT,
    editeur_id INT,
    PRIMARY KEY (jeu_id, editeur_id),
    FOREIGN KEY (jeu_id) REFERENCES Jeux(jeu_id),
    FOREIGN KEY (editeur_id) REFERENCES Editeurs(editeur_id)
);

CREATE TABLE Jeu_Categories (
    jeu_id INT,
    categorie_id INT,
    PRIMARY KEY (jeu_id, categorie_id),
    FOREIGN KEY (jeu_id) REFERENCES Jeux(jeu_id),
    FOREIGN KEY (categorie_id) REFERENCES Categories(categorie_id)
);

CREATE TABLE Jeu_Mecanisme (
    jeu_id INT,
    mecanisme_id INT,
    PRIMARY KEY (jeu_id, mecanisme_id),
    FOREIGN KEY (jeu_id) REFERENCES Jeux(jeu_id),
    FOREIGN KEY (mecanisme_id) REFERENCES Mecanismes(mecanisme_id)
);

CREATE TABLE Prets (
    pret_id INT PRIMARY KEY,
    boite_id INT,
    emprunteur_id INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (boite_id) REFERENCES Boites(boite_id),
    FOREIGN KEY (emprunteur_id) REFERENCES Emprunteurs(emprunteur_id)
);

CREATE TABLE Emprunteurs (
    emprunteur_id INT PRIMARY KEY,
    nom VARCHAR(255),
    email VARCHAR(255),
    telephone VARCHAR(255),
    adresse TEXT
);
