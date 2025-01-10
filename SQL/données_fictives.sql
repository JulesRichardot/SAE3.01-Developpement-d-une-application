-- Réinitialiser les tables et les identifiants
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE Pret;
TRUNCATE TABLE Boite;
TRUNCATE TABLE Jeu;
TRUNCATE TABLE Emprunteur;
TRUNCATE TABLE Utilisateur;
TRUNCATE TABLE Localisation;
TRUNCATE TABLE Collection;
TRUNCATE TABLE Mecanisme;
TRUNCATE TABLE Editeur;
TRUNCATE TABLE Auteur;
TRUNCATE TABLE Categorie;
TRUNCATE TABLE Jeu_Auteur;
TRUNCATE TABLE Jeu_Editeur;
TRUNCATE TABLE Jeu_Categorie;
SET FOREIGN_KEY_CHECKS = 1;

-- Utilisateurs
INSERT INTO Utilisateur (nom, email, mot_de_passe, role) VALUES
('Alice Dupont', 'alice@example.com', 'hashed_password1', 'Admin'),
('Bob Martin', 'bob@example.com', 'hashed_password2', 'Gestionnaire'),
('Charlie Rousseau', 'charlie@example.com', 'hashed_password3', 'Utilisateur'),
('Diane Morel', 'diane@example.com', 'hashed_password4', 'Utilisateur'),
('Eve Garnier', 'eve@example.com', 'hashed_password5', 'Utilisateur');

-- Emprunteurs
INSERT INTO Emprunteur (emprunteur_id, adresse, telephone) VALUES
(3, '123 Rue des Jeux, Paris', '0601020304'),
(4, '456 Avenue des Joueurs, Lyon', '0602030405'),
(5, '789 Boulevard du Fun, Marseille', '0603040506');

-- Mécanismes
INSERT INTO Mecanisme (nom) VALUES
('Deck-Building'),
('Stratégie'),
('Coopération');

-- Localisations
INSERT INTO Localisation (salle, etagere) VALUES
('Salle 1', 'Etagere A'),
('Salle 1', 'Etagere B'),
('Salle 2', 'Etagere C');

-- Collections
INSERT INTO Collection (nom) VALUES
('Jeux Classiques'),
('Jeux Modernes'),
('Jeux de Cartes');

-- Editeurs
INSERT INTO Editeur (nom) VALUES
('Riot Games'),
('Asmodee'),
('Hasbro');

-- Auteurs
INSERT INTO Auteur (nom) VALUES
('Richard Garfield'),
('Antoine Bauza'),
('Donald X. Vaccarino');

-- Jeux
INSERT INTO Jeu (titre, date_publication, nb_joueurs_min, nb_joueurs_max, age_minimum, mecanisme_id) VALUES
('Valorant', '2020-06-02', 5, 10, 16, 2),
('Pandemic', '2008-01-01', 2, 4, 8, 3),
('Dominion', '2008-01-01', 2, 4, 13, 1);

-- Boîtes
INSERT INTO Boite (jeu_id, etat, localisation_id, code_barre, collection_id) VALUES
(1, 'Neuf', 1, '1234567890123', 2),
(2, 'Bon état', 2, '2345678901234', 1),
(3, 'Usé', 3, '3456789012345', 2);

-- Prêts
INSERT INTO Pret (emprunteur_id, boite_id, date_emprunt, date_retour) VALUES
(3, 1, '2023-12-01', '2023-12-15'),
(4, 2, '2023-12-10', NULL),
(5, 3, '2023-12-05', '2023-12-20');

-- Catégories
INSERT INTO Categorie (nom) VALUES
('Stratégie'),
('Coopératif'),
('Deck-Building');

-- Jeux-Catégories
INSERT INTO Jeu_Categorie (jeu_id, categorie_id) VALUES
(1, 1),
(2, 2),
(3, 3);

-- Jeux-Auteurs
INSERT INTO Jeu_Auteur (jeu_id, auteur_id) VALUES
(1, 1),
(2, 2),
(3, 3);

-- Jeux-Editeurs
INSERT INTO Jeu_Editeur (jeu_id, editeur_id) VALUES
(1, 1),
(2, 2),
(3, 3);
