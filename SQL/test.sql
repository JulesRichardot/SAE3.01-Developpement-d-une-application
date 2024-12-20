INSERT INTO Mecanismes (mecanisme_id, nom) VALUES 
(1, 'Coopératif'),
(2, 'Déduction'),
(3, 'Deck Building');

INSERT INTO Jeux (jeu_id, titre, date_parution_debut, date_parution_fin, information_date, version, nombre_de_joueurs, age_indique, mots_cles, mecanisme_id) VALUES
(1, 'Pandemic', 2008, 2008, 'Première édition', '1.0', '2-4', '8+', 'sauver le monde, coopératif', 1),
(2, 'Codenames', 2015, 2015, 'Standard', '1.0', '2-8', '10+', 'espionnage, déduction', 2),
(3, 'Dominion', 2008, 2008, 'Original', '1.0', '2-4', '13+', 'deck building, stratégie', 3);

INSERT INTO Boites (boite_id, jeu_id, etat, localisation_id, code_barre, collection_id) VALUES
(1, 1, 'Neuf', 1, '1234567890123', 1),
(2, 2, 'Bon', 2, '2345678901234', 2),
(3, 3, 'Neuf', 3, '3456789012345', 3);

INSERT INTO Auteurs (auteur_id, nom) VALUES
(1, 'Matt Leacock'),
(2, 'Vlaada Chvátil'),
(3, 'Donald X. Vaccarino');

INSERT INTO Jeu_Auteur (jeu_id, auteur_id) VALUES
(1, 1), -- Pandemic par Matt Leacock
(2, 2), -- Codenames par Vlaada Chvátil
(3, 3); -- Dominion par Donald X. Vaccarino

INSERT INTO Editeurs (editeur_id, nom) VALUES
(1, 'Z-Man Games'),
(2, 'Czech Games Edition'),
(3, 'Rio Grande Games');

INSERT INTO Jeu_Editeur (jeu_id, editeur_id) VALUES
(1, 1), -- Pandemic édité par Z-Man Games
(2, 2), -- Codenames édité par Czech Games Edition
(3, 3); -- Dominion édité par Rio Grande Games

INSERT INTO Categories (categorie_id, nom) VALUES
(1, 'Stratégie'),
(2, 'Famille'),
(3, 'Coopératif');

INSERT INTO Jeu_Categories (jeu_id, categorie_id) VALUES
(1, 3), -- Pandemic est coopératif
(2, 2), -- Codenames est un jeu familial
(3, 1); -- Dominion est un jeu de stratégie

INSERT INTO Localisations (localisation_id, salle, etagere) VALUES
(1, 'Salle 1', 'Étagère A'),
(2, 'Salle 1', 'Étagère B'),
(3, 'Salle 2', 'Étagère C');

INSERT INTO Collections (collection_id, nom) VALUES
(1, 'Jeux modernes'),
(2, 'Classiques familiaux'),
(3, 'Jeux de cartes');

INSERT INTO Emprunteurs (emprunteur_id, nom, email, telephone, adresse) VALUES
(1, 'Alice Dupont', 'alice@example.com', '0123456789', '123 Rue Principale'),
(2, 'Bob Martin', 'bob@example.com', '0987654321', '456 Avenue Centrale');

INSERT INTO Prets (pret_id, boite_id, emprunteur_id, date_emprunt, date_retour) VALUES
(1, 1, 1, '2024-12-01', '2024-12-15'), -- Alice emprunte Pandemic
(2, 2, 2, '2024-12-05', '2024-12-20'); -- Bob emprunte Codenames
