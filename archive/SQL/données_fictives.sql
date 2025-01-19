-- Réinitialiser les tables
SET FOREIGN_KEY_CHECKS = 0;
TRUNCATE TABLE jeu_categorie;
TRUNCATE TABLE jeu_auteur;
TRUNCATE TABLE jeu_editeur;
TRUNCATE TABLE pret;
TRUNCATE TABLE boite;
TRUNCATE TABLE jeu;
TRUNCATE TABLE emprunteur;
TRUNCATE TABLE utilisateur;
TRUNCATE TABLE localisation;
TRUNCATE TABLE collection;
TRUNCATE TABLE mecanisme;
TRUNCATE TABLE editeur;
TRUNCATE TABLE auteur;
TRUNCATE TABLE categorie;
SET FOREIGN_KEY_CHECKS = 1;

-- Insérer les utilisateurs
INSERT INTO utilisateur (nom, email, mot_de_passe, role) VALUES
('Alice Dupont', 'alice@example.com', 'hashed_password1', 'Admin'),
('Bob Martin', 'bob@example.com', 'hashed_password2', 'Gestionnaire'),
('Charlie Rousseau', 'charlie@example.com', 'hashed_password3', 'Utilisateur'),
('Diane Morel', 'diane@example.com', 'hashed_password4', 'Utilisateur'),
('Eve Garnier', 'eve@example.com', 'hashed_password5', 'Utilisateur');

-- Insérer les emprunteurs
INSERT INTO emprunteur (emprunteur_id, adresse, telephone) VALUES
(3, '123 Rue des Jeux, Paris', '0601020304'),
(4, '456 Avenue des Joueurs, Lyon', '0602030405'),
(5, '789 Boulevard du Fun, Marseille', '0603040506');

-- Insérer les mécanismes
INSERT INTO mecanisme (nom) VALUES
('Deck-Building'),
('Stratégie'),
('Coopération'),
('Puzzle'),
('Gestion de ressources');

-- Insérer les localisations
INSERT INTO localisation (salle, etagere) VALUES
('Salle 1', 'Etagere A'),
('Salle 1', 'Etagere B'),
('Salle 2', 'Etagere C');

-- Insérer les collections
INSERT INTO collection (nom) VALUES
('Jeux Classiques'),
('Jeux Modernes'),
('Jeux de Cartes');

-- Insérer les éditeurs
INSERT INTO editeur (nom) VALUES
('Riot Games'),
('Asmodee'),
('Hasbro');

-- Insérer les auteurs
INSERT INTO auteur (nom) VALUES
('Richard Garfield'),
('Antoine Bauza'),
('Donald X. Vaccarino');

-- Insérer les catégories
INSERT INTO categorie (nom) VALUES
('Stratégie'),
('Coopératif'),
('Deck-Building'),
('Famille'),
('Exploration');

-- Insérer les jeux
INSERT INTO jeu (titre, date_publication, nb_joueurs_min, nb_joueurs_max, age_minimum, mecanisme_id) VALUES
('Valorant', '2020-06-02', 5, 10, 16, 2),
('Pandemic', '2008-01-01', 2, 4, 8, 3),
('Dominion', '2008-01-01', 2, 4, 13, 1),
('7 Wonders', '2010-04-30', 2, 7, 10, 5),
('Uno', '1971-01-01', 2, 10, 7, 4);

-- Insérer les boîtes
INSERT INTO boite (jeu_id, etat, localisation_id, code_barre, collection_id) VALUES
(1, 'Neuf', 1, '1234567890123', 2),
(2, 'Bon état', 2, '2345678901234', 1),
(3, 'Usé', 3, '3456789012345', 2),
(4, 'Neuf', 1, '4567890123456', 3),
(5, 'Bon état', 2, '5678901234567', 1);

-- Insérer les prêts
INSERT INTO pret (emprunteur_id, id_boite, date_emprunt, date_retour) VALUES
(3, 1, '2023-12-01', '2023-12-15'),
(4, 2, '2023-12-10', NULL),
(5, 3, '2023-12-05', '2023-12-20'),
(3, 4, '2023-12-15', NULL),
(4, 5, '2023-12-20', NULL);

-- Associer les jeux aux catégories
INSERT INTO jeu_categorie (id_jeu, id_categorie) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- Associer les jeux aux auteurs
INSERT INTO jeu_auteur (id_jeu, auteur_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 2),
(5, 1);

-- Associer les jeux aux éditeurs
INSERT INTO jeu_editeur (id_jeu, editeur_id) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 2),
(5, 3);
