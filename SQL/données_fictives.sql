-- Réinitialiser les tables et les identifiants
TRUNCATE TABLE Pret RESTART IDENTITY CASCADE;
TRUNCATE TABLE Boite RESTART IDENTITY CASCADE;
TRUNCATE TABLE Jeu RESTART IDENTITY CASCADE;
TRUNCATE TABLE Emprunteur RESTART IDENTITY CASCADE;
TRUNCATE TABLE Utilisateur RESTART IDENTITY CASCADE;
TRUNCATE TABLE Localisation RESTART IDENTITY CASCADE;
TRUNCATE TABLE Collection RESTART IDENTITY CASCADE;
TRUNCATE TABLE Mecanisme RESTART IDENTITY CASCADE;
TRUNCATE TABLE Editeur RESTART IDENTITY CASCADE;
TRUNCATE TABLE Auteur RESTART IDENTITY CASCADE;
TRUNCATE TABLE Categorie RESTART IDENTITY CASCADE;
TRUNCATE TABLE Jeu_Auteur RESTART IDENTITY CASCADE;
TRUNCATE TABLE Jeu_Editeur RESTART IDENTITY CASCADE;
TRUNCATE TABLE Jeu_Categorie RESTART IDENTITY CASCADE;

-- Utilisateurs
INSERT INTO Utilisateur (nom, email, mot_de_passe, role) VALUES
('Alice Dupont', 'alice@example.com', 'hashed_password1', 'Admin'),
('Bob Martin', 'bob@example.com', 'hashed_password2', 'Gestionnaire'),
('Charlie Rousseau', 'charlie@example.com', 'hashed_password3', 'Utilisateur'),
('Diane Morel', 'diane@example.com', 'hashed_password4', 'Utilisateur'),
('Eve Garnier', 'eve@example.com', 'hashed_password5', 'Utilisateur'),
('François Lemoine', 'francois@example.com', 'hashed_password6', 'Utilisateur'),
('Gérard Martin', 'gerard@example.com', 'hashed_password7', 'Utilisateur'),
('Hélène Fabre', 'helene@example.com', 'hashed_password8', 'Utilisateur'),
('Isabelle Petit', 'isabelle@example.com', 'hashed_password9', 'Utilisateur'),
('Julien Blanc', 'julien@example.com', 'hashed_password10', 'Utilisateur');

-- Emprunteurs
INSERT INTO Emprunteur (emprunteur_id, adresse, telephone) VALUES
(3, '123 Rue des Jeux, Paris', '0601020304'),
(4, '456 Avenue des Joueurs, Lyon', '0602030405'),
(5, '789 Boulevard du Fun, Marseille', '0603040506'),
(6, '101 Rue des Énigmes, Lille', '0604050607'),
(7, '202 Boulevard des Cartes, Nice', '0605060708'),
(8, '303 Allée des Pions, Bordeaux', '0606070809'),
(9, '404 Place des Dés, Toulouse', '0607080910');

-- Mécanismes
INSERT INTO Mecanisme (nom) VALUES
('Deck-Building'),
('Stratégie'),
('Coopération'),
('Puzzle'),
('Gestion de ressources'),
('Bluff'),
('Exploration'),
('Combat');

-- Localisations
INSERT INTO Localisation (salle, etagere) VALUES
('Salle 1', 'Etagere A'),
('Salle 1', 'Etagere B'),
('Salle 2', 'Etagere C'),
('Salle 3', 'Etagere D'),
('Salle 3', 'Etagere E');

-- Collections
INSERT INTO Collection (nom) VALUES
('Jeux Classiques'),
('Jeux Modernes'),
('Jeux de Cartes'),
('Jeux de Plateau');

-- Editeurs
INSERT INTO Editeur (nom) VALUES
('Riot Games'),
('Asmodee'),
('Hasbro'),
('Mattel'),
('Days of Wonder');

-- Auteurs
INSERT INTO Auteur (nom) VALUES
('Richard Garfield'),
('Antoine Bauza'),
('Donald X. Vaccarino'),
('Bruno Cathala'),
('Uwe Rosenberg'),
('Stefan Feld');

-- Jeux
INSERT INTO Jeu (titre, date_publication, nb_joueurs_min, nb_joueurs_max, age_minimum, mecanisme_id) VALUES
('Valorant', '2020-06-02', 5, 10, 16, 2),
('Pandemic', '2008-01-01', 2, 4, 8, 3),
('Dominion', '2008-01-01', 2, 4, 13, 1),
('7 Wonders', '2010-04-30', 2, 7, 10, 5),
('Uno', '1971-01-01', 2, 10, 7, 4),
('Catan', '1995-01-01', 3, 4, 10, 2),
('Carcassonne', '2000-01-01', 2, 5, 8, 5),
('Terraforming Mars', '2016-01-01', 1, 5, 12, 5),
('Splendor', '2014-01-01', 2, 4, 10, 1),
('Ticket to Ride', '2004-01-01', 2, 5, 8, 2);

-- Boîtes
INSERT INTO Boite (jeu_id, etat, localisation_id, code_barre, collection_id) VALUES
(1, 'Neuf', 1, '1234567890123', 2),
(2, 'Bon état', 2, '2345678901234', 1),
(3, 'Usé', 3, '3456789012345', 2),
(4, 'Neuf', 4, '4567890123456', 3),
(5, 'Bon état', 1, '5678901234567', 1),
(6, 'Neuf', 5, '6789012345678', 4),
(7, 'Usé', 3, '7890123456789', 2),
(8, 'Neuf', 4, '8901234567890', 3),
(9, 'Bon état', 2, '9012345678901', 4),
(10, 'Neuf', 5, '0123456789012', 3);

-- Prêts
INSERT INTO Pret (emprunteur_id, boite_id, date_emprunt, date_retour) VALUES
(3, 1, '2023-12-01', '2023-12-15'),
(3, 2, '2023-12-10', NULL),
(4, 3, '2023-12-05', '2023-12-20'),
(5, 4, '2023-12-12', NULL),
(4, 5, '2023-12-15', NULL),
(6, 6, '2023-12-08', '2023-12-22'),
(7, 7, '2023-12-03', NULL),
(8, 8, '2023-12-10', '2023-12-20'),
(9, 9, '2023-12-14', NULL),
(5, 10, '2023-12-18', NULL);

-- Catégories
INSERT INTO Categorie (nom) VALUES
('Stratégie'),
('Coopératif'),
('Deck-Building'),
('Famille'),
('Exploration'),
('Puzzle'),
('Bluff');

-- Jeux-Catégories
INSERT INTO Jeu_Categorie (jeu_id, categorie_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 1),
(5, 4),
(6, 1),
(7, 5),
(8, 1),
(9, 3),
(10, 5);

-- Jeux-Auteurs
INSERT INTO Jeu_Auteur (jeu_id, auteur_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 4),
(6, 5),
(7, 6),
(8, 5),
(9, 1),
(10, 6);

-- Jeux-Editeurs
INSERT INTO Jeu_Editeur (jeu_id, editeur_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 2),
(5, 4),
(6, 5),
(7, 3),
(8, 5),
(9, 4),
(10, 2);
