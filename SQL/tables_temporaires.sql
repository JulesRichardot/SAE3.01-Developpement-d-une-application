-- Création des tables de base
CREATE TABLE Mecanisme (
    mecanisme_id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Localisation (
    localisation_id SERIAL PRIMARY KEY,
    salle VARCHAR(50) NOT NULL,
    etagere VARCHAR(50) NOT NULL
);

CREATE TABLE Collection (
    collection_id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Editeur (
    editeur_id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Auteur (
    auteur_id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE Categorie (
    categorie_id SERIAL PRIMARY KEY,
    nom VARCHAR(255) NOT NULL
);

-- Création des tables intermédiaires
CREATE TABLE Jeu (
    jeu_id SERIAL PRIMARY KEY,
    titre VARCHAR(255) NOT NULL,
    date_publication DATE,
    nb_joueurs_min INT,
    nb_joueurs_max INT,
    age_minimum INT,
    mecanisme_id INT,
    CONSTRAINT fk_jeu_mecanisme FOREIGN KEY (mecanisme_id) REFERENCES Mecanisme(mecanisme_id)
);

CREATE TABLE Utilisateur (
    utilisateur_id SERIAL PRIMARY KEY,
    nom VARCHAR(50) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role VARCHAR(20) CHECK (role IN ('Admin', 'Gestionnaire', 'Utilisateur')) NOT NULL
);

-- Création des tables dépendantes
CREATE TABLE Boite (
    boite_id SERIAL PRIMARY KEY,
    jeu_id INT NOT NULL,
    etat VARCHAR(50) NOT NULL,
    localisation_id INT NOT NULL,
    code_barre VARCHAR(50),
    collection_id INT,
    CONSTRAINT fk_boite_jeu FOREIGN KEY (jeu_id) REFERENCES Jeu(jeu_id),
    CONSTRAINT fk_boite_localisation FOREIGN KEY (localisation_id) REFERENCES Localisation(localisation_id),
    CONSTRAINT fk_boite_collection FOREIGN KEY (collection_id) REFERENCES Collection(collection_id)
);

CREATE TABLE Emprunteur (
    emprunteur_id INT PRIMARY KEY,
    adresse TEXT NOT NULL,
    telephone VARCHAR(15) NOT NULL,
    CONSTRAINT fk_emprunteur_utilisateur FOREIGN KEY (emprunteur_id) REFERENCES Utilisateur(utilisateur_id)
);

-- Création des tables finales
CREATE TABLE Pret (
    pret_id SERIAL PRIMARY KEY,
    emprunteur_id INT NOT NULL,
    boite_id INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE NULL,
    CONSTRAINT fk_pret_emprunteur FOREIGN KEY (emprunteur_id) REFERENCES Emprunteur(emprunteur_id),
    CONSTRAINT fk_pret_boite FOREIGN KEY (boite_id) REFERENCES Boite(boite_id)
);

CREATE TABLE Jeu_Auteur (
    jeu_id INT NOT NULL,
    auteur_id INT NOT NULL,
    CONSTRAINT fk_jeu_auteur_jeu FOREIGN KEY (jeu_id) REFERENCES Jeu(jeu_id),
    CONSTRAINT fk_jeu_auteur_auteur FOREIGN KEY (auteur_id) REFERENCES Auteur(auteur_id),
    PRIMARY KEY (jeu_id, auteur_id)
);

CREATE TABLE Jeu_Editeur (
    jeu_id INT NOT NULL,
    editeur_id INT NOT NULL,
    CONSTRAINT fk_jeu_editeur_jeu FOREIGN KEY (jeu_id) REFERENCES Jeu(jeu_id),
    CONSTRAINT fk_jeu_editeur_editeur FOREIGN KEY (editeur_id) REFERENCES Editeur(editeur_id),
    PRIMARY KEY (jeu_id, editeur_id)
);

CREATE TABLE Jeu_Categorie (
    jeu_id INT NOT NULL,
    categorie_id INT NOT NULL,
    CONSTRAINT fk_jeu_categorie_jeu FOREIGN KEY (jeu_id) REFERENCES Jeu(jeu_id),
    CONSTRAINT fk_jeu_categorie_categorie FOREIGN KEY (categorie_id) REFERENCES Categorie(categorie_id),
    PRIMARY KEY (jeu_id, categorie_id)
);
