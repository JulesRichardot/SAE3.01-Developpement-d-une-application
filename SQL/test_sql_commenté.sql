-- 1. Tester les jeux les plus empruntés
-- Affiche les jeux triés par leur popularité (nombre d'emprunts)
SELECT 
    j.titre AS jeu,
    COUNT(p.id_pret) AS nb_emprunts
FROM pret p
JOIN boite b ON p.id_boite = b.id_boite
JOIN jeu j ON b.jeu_id = j.id_jeu
GROUP BY j.titre
ORDER BY nb_emprunts DESC;

-- 2. Tester les emprunts en cours
-- Liste tous les emprunts qui n'ont pas encore été retournés
SELECT 
    u.nom AS utilisateur,
    j.titre AS jeu,
    p.date_emprunt
FROM pret p
JOIN emprunteur e ON p.emprunteur_id = e.emprunteur_id
JOIN utilisateur u ON e.emprunteur_id = u.utilisateur_id
JOIN boite b ON p.id_boite = b.id_boite
JOIN jeu j ON b.jeu_id = j.id_jeu
WHERE p.date_retour IS NULL;

-- 3. Tester les jeux jamais empruntés
-- Trouve les jeux disponibles mais qui n'ont jamais été empruntés
SELECT 
    j.titre AS jeu,
    b.id_boite AS boite
FROM boite b
JOIN jeu j ON b.jeu_id = j.id_jeu
WHERE b.id_boite NOT IN (SELECT id_boite FROM pret);

-- 4. Tester les emprunteurs d’un jeu spécifique
-- Par exemple, affiche les utilisateurs ayant emprunté "Valorant"
SELECT 
    u.nom AS utilisateur,
    u.email AS email,
    p.date_emprunt,
    p.date_retour
FROM pret p
JOIN emprunteur e ON p.emprunteur_id = e.emprunteur_id
JOIN utilisateur u ON e.emprunteur_id = u.utilisateur_id
JOIN boite b ON p.id_boite = b.id_boite
JOIN jeu j ON b.jeu_id = j.id_jeu
WHERE j.titre = 'Valorant';

-- 5. Tester la localisation des jeux
-- Trouve les jeux disponibles dans une salle donnée (exemple : "Salle 1")
SELECT 
    j.titre AS jeu,
    b.etat AS etat,
    l.salle AS salle,
    l.etagere AS etagere
FROM boite b
JOIN jeu j ON b.jeu_id = j.id_jeu
JOIN localisation l ON b.localisation_id = l.localisation_id
WHERE l.salle = 'Salle 1';

-- 6. Tester les catégories associées aux jeux
-- Affiche toutes les catégories liées à chaque jeu
SELECT 
    j.titre AS jeu,
    c.nom AS categorie
FROM jeu j
JOIN jeu_categorie jc ON j.id_jeu = jc.id_jeu
JOIN categorie c ON jc.id_categorie = c.categorie_id
ORDER BY j.titre;

-- 7. Tester les jeux d’un auteur spécifique
-- Par exemple, trouve les jeux créés par "Bruno Cathala"
SELECT 
    j.titre AS jeu,
    a.nom AS auteur
FROM jeu j
JOIN jeu_auteur ja ON j.id_jeu = ja.id_jeu
JOIN auteur a ON ja.auteur_id = a.auteur_id
WHERE a.nom = 'Antoine Bauza';

-- 8. Tester les jeux par éditeur avec leurs emprunts
-- Affiche les éditeurs et le nombre d'emprunts de leurs jeux
SELECT 
    e.nom AS editeur,
    COUNT(p.id_pret) AS nb_emprunts
FROM pret p
JOIN boite b ON p.id_boite = b.id_boite
JOIN jeu j ON b.jeu_id = j.id_jeu
JOIN jeu_editeur je ON j.id_jeu = je.id_jeu
JOIN editeur e ON je.editeur_id = e.editeur_id
GROUP BY e.nom
ORDER BY nb_emprunts DESC;

-- 9. Tester les utilisateurs qui n’ont jamais emprunté
-- Trouve les utilisateurs qui ne figurent pas dans la table "pret"
SELECT 
    u.nom AS utilisateur,
    u.email AS email
FROM utilisateur u
WHERE u.utilisateur_id NOT IN (SELECT emprunteur_id FROM emprunteur);

-- 10. Tester le nombre d'emprunts par utilisateur
-- Affiche combien de jeux chaque utilisateur a emprunté
SELECT 
    u.nom AS utilisateur,
    COUNT(p.id_pret) AS nb_emprunts
FROM pret p
JOIN emprunteur e ON p.emprunteur_id = e.emprunteur_id
JOIN utilisateur u ON e.emprunteur_id = u.utilisateur_id
GROUP BY u.nom
ORDER BY nb_emprunts DESC;

-- 11. Tester les jeux par localisation
-- Trouve les jeux disponibles dans toutes les localisations
SELECT 
    j.titre AS jeu,
    l.salle AS salle,
    l.etagere AS etagere
FROM boite b
JOIN jeu j ON b.jeu_id = j.id_jeu
JOIN localisation l ON b.localisation_id = l.localisation_id;

-- 12. Trouver les jeux les plus populaires par catégorie
-- Liste les jeux les plus empruntés dans chaque catégorie
SELECT 
    c.nom AS categorie,
    j.titre AS jeu,
    COUNT(p.id_pret) AS nb_emprunts
FROM pret p
JOIN boite b ON p.id_boite = b.id_boite
JOIN jeu j ON b.jeu_id = j.id_jeu
JOIN jeu_categorie jc ON j.id_jeu = jc.id_jeu
JOIN categorie c ON jc.id_categorie = c.categorie_id
GROUP BY c.nom, j.titre
ORDER BY c.nom, nb_emprunts DESC;

-- 13. Lister les emprunts multiples d’une même boîte
-- Trouve les boîtes empruntées plusieurs fois
SELECT 
    b.id_boite AS boite,
    j.titre AS jeu,
    COUNT(p.id_pret) AS nb_emprunts
FROM pret p
JOIN boite b ON p.id_boite = b.id_boite
JOIN jeu j ON b.jeu_id = j.id_jeu
GROUP BY b.id_boite, j.titre
HAVING nb_emprunts > 1;
