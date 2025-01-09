-- 1. Tester les jeux les plus empruntés
-- Cette requête affiche les jeux triés par leur popularité (nombre d'emprunts)
SELECT 
    j.titre AS jeu,
    COUNT(p.pret_id) AS nb_emprunts
FROM Pret p
JOIN Boite b ON p.boite_id = b.boite_id
JOIN Jeu j ON b.jeu_id = j.jeu_id
GROUP BY j.titre
ORDER BY nb_emprunts DESC;

-- 2. Tester les emprunts en cours
-- Liste tous les emprunts qui n'ont pas encore été retournés
SELECT 
    u.nom AS utilisateur,
    j.titre AS jeu,
    p.date_emprunt
FROM Pret p
JOIN Emprunteur e ON p.emprunteur_id = e.emprunteur_id
JOIN Utilisateur u ON e.emprunteur_id = u.utilisateur_id
JOIN Boite b ON p.boite_id = b.boite_id
JOIN Jeu j ON b.jeu_id = j.jeu_id
WHERE p.date_retour IS NULL;

-- 3. Tester les jeux jamais empruntés
-- Trouve les jeux disponibles mais qui n'ont jamais été empruntés
SELECT 
    j.titre AS jeu,
    b.boite_id AS boite
FROM Boite b
JOIN Jeu j ON b.jeu_id = j.jeu_id
WHERE b.boite_id NOT IN (SELECT boite_id FROM Pret);

-- 4. Tester les emprunteurs d’un jeu spécifique
-- Par exemple, affiche les utilisateurs ayant emprunté "Valorant"
SELECT 
    u.nom AS utilisateur,
    u.email AS email,
    p.date_emprunt,
    p.date_retour
FROM Pret p
JOIN Emprunteur e ON p.emprunteur_id = e.emprunteur_id
JOIN Utilisateur u ON e.emprunteur_id = u.utilisateur_id
JOIN Boite b ON p.boite_id = b.boite_id
JOIN Jeu j ON b.jeu_id = j.jeu_id
WHERE j.titre = 'Valorant';

-- 5. Tester la localisation des jeux
-- Trouve les jeux disponibles dans une salle donnée (exemple : "Salle 1")
SELECT 
    j.titre AS jeu,
    b.etat AS etat,
    l.salle AS salle,
    l.etagere AS etagere
FROM Boite b
JOIN Jeu j ON b.jeu_id = j.jeu_id
JOIN Localisation l ON b.localisation_id = l.localisation_id
WHERE l.salle = 'Salle 1';

-- 6. Tester les catégories associées aux jeux
-- Affiche toutes les catégories liées à chaque jeu
SELECT 
    j.titre AS jeu,
    c.nom AS categorie
FROM Jeu j
JOIN Jeu_Categorie jc ON j.jeu_id = jc.jeu_id
JOIN Categorie c ON jc.categorie_id = c.categorie_id
ORDER BY j.titre;

-- 7. Tester les jeux d’un auteur spécifique
-- Par exemple, trouve les jeux créés par "Bruno Cathala"
SELECT 
    j.titre AS jeu,
    a.nom AS auteur
FROM Jeu j
JOIN Jeu_Auteur ja ON j.jeu_id = ja.jeu_id
JOIN Auteur a ON ja.auteur_id = a.auteur_id
WHERE a.nom = 'Bruno Cathala';

-- 8. Tester les jeux par éditeur avec leurs emprunts
-- Affiche les éditeurs et le nombre d'emprunts de leurs jeux
SELECT 
    e.nom AS editeur,
    COUNT(p.pret_id) AS nb_emprunts
FROM Pret p
JOIN Boite b ON p.boite_id = b.boite_id
JOIN Jeu j ON b.jeu_id = j.jeu_id
JOIN Jeu_Editeur je ON j.jeu_id = je.jeu_id
JOIN Editeur e ON je.editeur_id = e.editeur_id
GROUP BY e.nom
ORDER BY nb_emprunts DESC;

-- 9. Tester les utilisateurs qui n’ont jamais emprunté
-- Trouve les utilisateurs qui ne figurent pas dans la table "Pret"
SELECT 
    u.nom AS utilisateur,
    u.email AS email
FROM Utilisateur u
WHERE u.utilisateur_id NOT IN (SELECT emprunteur_id FROM Pret);

-- 10. Tester le nombre d'emprunts par utilisateur
-- Affiche combien de jeux chaque utilisateur a emprunté
SELECT 
    u.nom AS utilisateur,
    COUNT(p.pret_id) AS nb_emprunts
FROM Pret p
JOIN Emprunteur e ON p.emprunteur_id = e.emprunteur_id
JOIN Utilisateur u ON e.emprunteur_id = u.utilisateur_id
GROUP BY u.nom
ORDER BY nb_emprunts DESC;

-- 11. Tester les jeux par localisation
-- Trouve les jeux disponibles dans toutes les localisations
SELECT 
    j.titre AS jeu,
    l.salle AS salle,
    l.etagere AS etagere
FROM Boite b
JOIN Jeu j ON b.jeu_id = j.jeu_id
JOIN Localisation l ON b.localisation_id = l.localisation_id;
