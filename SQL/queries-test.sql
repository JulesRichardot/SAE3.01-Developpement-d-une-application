SELECT * FROM Jeux;

SELECT j.*
FROM Jeux j
JOIN Jeu_Categories jc ON j.jeu_id = jc.jeu_id
JOIN Categories c ON jc.categorie_id = c.categorie_id
WHERE c.nom = 'Stratégie';

SELECT * FROM Jeux WHERE age_indique <= '10';

SELECT b.*
FROM Boites b
LEFT JOIN Prets p ON b.boite_id = p.boite_id AND p.date_retour IS NULL
WHERE p.boite_id IS NULL;

SELECT j.titre, e.nom AS emprunteur, p.date_emprunt, p.date_retour
FROM Prets p
JOIN Boites b ON p.boite_id = b.boite_id
JOIN Jeux j ON b.jeu_id = j.jeu_id
JOIN Emprunteurs e ON p.emprunteur_id = e.emprunteur_id;

SELECT j.titre, p.date_emprunt, p.date_retour
FROM Prets p
JOIN Boites b ON p.boite_id = b.boite_id
JOIN Jeux j ON b.jeu_id = j.jeu_id
WHERE p.emprunteur_id = 1; 

SELECT l.salle, l.etagere, COUNT(b.boite_id) AS nb_disponibles
FROM Boites b
JOIN Localisations l ON b.localisation_id = l.localisation_id
LEFT JOIN Prets p ON b.boite_id = p.boite_id AND p.date_retour IS NULL
WHERE p.boite_id IS NULL
GROUP BY l.salle, l.etagere;

UPDATE Boites 
SET etat = 'Endommagée'
WHERE boite_id = 3; 

DELETE FROM Prets
WHERE pret_id = 5; 

INSERT INTO Prets (boite_id, emprunteur_id, date_emprunt, date_retour)
VALUES (2, 1, '2024-12-22', '2025-01-05'); 

SELECT * FROM Boites
WHERE etat IN ('Endommagée', 'Mauvais état');

SELECT * FROM Jeux
WHERE titre LIKE '%Catan%' OR mots_cles LIKE '%aventure%';

SELECT j.titre, a.nom AS auteur
FROM Jeu_Auteur ja
JOIN Jeux j ON ja.jeu_id = j.jeu_id
JOIN Auteurs a ON ja.auteur_id = a.auteur_id
WHERE a.nom = 'Auteur Exemple'; 

SELECT j.titre, e.nom AS editeur
FROM Jeu_Editeur je
JOIN Jeux j ON je.jeu_id = j.jeu_id
JOIN Editeurs e ON je.editeur_id = e.editeur_id
WHERE e.nom = 'Editeur Exemple'; 
