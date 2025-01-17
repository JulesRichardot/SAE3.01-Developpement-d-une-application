-- INSERTIONS


-- mecanisme
INSERT IGNORE INTO mecanisme (nom)
SELECT DISTINCT mecanisme1 FROM TempJeux WHERE mecanisme1 IS NOT NULL
UNION
SELECT DISTINCT mecanisme2 FROM TempJeux WHERE mecanisme2 IS NOT NULL
UNION
SELECT DISTINCT mecanisme3 FROM TempJeux WHERE mecanisme3 IS NOT NULL;

-- localisation
INSERT IGNORE INTO localisation (salle, etagere)
SELECT DISTINCT 
    SUBSTRING_INDEX(localisation_cnj, ' ', 1) AS salle,        -- Partie avant l'espace
    SUBSTRING_INDEX(localisation_cnj, ' ', -1) AS etagere       -- Partie après l'espace
FROM TempJeux 
WHERE localisation_cnj IS NOT NULL 
  AND localisation_cnj LIKE '% %';  -- Assurer qu'il y a un espace

-- collection
INSERT IGNORE INTO collection (nom)
SELECT DISTINCT collection_origine FROM TempJeux WHERE collection_origine IS NOT NULL;

-- auteur
INSERT IGNORE INTO auteur (nom)
SELECT DISTINCT auteurs FROM TempJeux WHERE auteurs IS NOT NULL;

-- editeur
INSERT IGNORE INTO editeur (nom)
SELECT DISTINCT ref FROM TempJeux WHERE ref IS NOT NULL;

-- categorie
INSERT IGNORE INTO categorie (nom)
SELECT DISTINCT mots_cles FROM TempJeux WHERE mots_cles IS NOT NULL;

-- jeu
INSERT INTO jeu (identifiant, titre, date_parution_debut, date_parution_fin, information_date, version, nombre_de_joueurs, age_indique, mots_cles, mecanisme_id)
SELECT 
    id_jeu,
    titre_jeu,
    date_parution_debut,
    date_parution_fin,
    information_date,
    version,
    nombre_joueurs,
    age_min,
    mots_cles,
    (SELECT mecanisme_id FROM mecanisme WHERE nom = mecanisme1 LIMIT 1) AS mecanisme_id
FROM TempJeux
WHERE titre_jeu IS NOT NULL AND titre_jeu != '';

-- boite
INSERT INTO boite (jeu_id, etat, localisation_id, code_barre, collection_id)
SELECT 
    j.id_jeu,
    t.etat,
    l.localisation_id,
    t.code_barre,
    c.collection_id
FROM TempJeux t
JOIN jeu j ON t.id_jeu = j.id_jeu
JOIN localisation l ON SUBSTRING_INDEX(t.localisation_cnj, ' ', 1) = l.salle
  AND SUBSTRING_INDEX(t.localisation_cnj, ' ', -1) = l.etagere
JOIN collection c ON t.collection_origine = c.nom
WHERE t.localisation_cnj IS NOT NULL AND t.collection_origine IS NOT NULL;

-- jeu_categorie
INSERT IGNORE INTO jeu_categorie (id_jeu, id_categorie)
SELECT 
    j.id_jeu,
    c.id_categorie
FROM TempJeux t
JOIN jeu j ON t.id_jeu = j.id_jeu
JOIN categorie c ON t.mots_cles LIKE CONCAT('%', c.nom, '%')  -- Si mots_cles contient des catégories
WHERE t.mots_cles IS NOT NULL;

-- jeu auteur
INSERT IGNORE INTO jeu_auteur (id_jeu, auteur_id)
SELECT 
    j.id_jeu,
    a.auteur_id
FROM TempJeux t
JOIN jeu j ON t.id_jeu = j.id_jeu
JOIN auteur a ON FIND_IN_SET(a.nom, t.auteurs) > 0  -- Si les auteurs sont séparés par des virgules
WHERE t.auteurs IS NOT NULL;

-- jeu editeur
INSERT IGNORE INTO jeu_editeur (id_jeu, editeur_id)
SELECT 
    j.id_jeu,
    e.editeur_id
FROM TempJeux t
JOIN jeu j ON t.id_jeu = j.id_jeu
JOIN editeur e ON t.ref = e.nom
WHERE t.ref IS NOT NULL;

-- pret
INSERT INTO pret (emprunteur_id, id_boite, date_emprunt, date_retour)
SELECT 
    e.emprunteur_id,
    b.id_boite,
    t.information_date,  -- Par exemple, utiliser la date d'information comme date d'emprunt
    NULL  -- Vous pouvez mettre NULL pour la date de retour si elle n'est pas précisée
FROM TempJeux t
JOIN boite b ON t.num_boite = b.id_boite
JOIN utilisateur u ON u.email = t.auteurs  -- Associer par email si possible
JOIN emprunteur e ON e.emprunteur_id = u.utilisateur_id -- Lier l'utilisateur à l'emprunteur
WHERE t.information_date IS NOT NULL;


