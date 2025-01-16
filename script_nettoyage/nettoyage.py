from utils import *

def nettoyer_excel(data: pd.DataFrame) -> bool: # CHANGER LE RETURN APRES
    """
    Fonction qui va faire un nettoyage complet sur les données Excel.
    Cette fonction va effectuer plusieurs étapes: 
        - supprimer les doublons
        - gérer les valeurs manquantes
        - enlever les espaces en trop dans les colonnes de texte
        - formater les dates
        - gérer les valeurs incohérentes
        - ?renommer les colonnes?
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données Excel

    Returns:
        pd.DataFrame: DataFrame nettoyé
    """

    data = data.drop_duplicates()
    #data = nettoyer_lignes_vides(data)
    

    
    jeux = data.rename(columns={
        "Unnamed: 0": "id_jeu",
        "TITRE": "titre_jeu",
        "REFERENCES (éditeur/distributeur)": "References",
        "AUTEURS": "auteurs",
        "DATE DE PARUTION DEBUT": "date_parution_debut",
        "DATE DE PARUTION FIN": "date_parution_fin",
        "INFORMATION DATE": "information_date",
        "VERSION": "version",
        "NOMBRE DE JOUEURS": "nombre_joueurs",
        "AGE INDIQUE (cf colonne B)": "age_min",
        "MOTS CLES": "mots_cles",
        "N Boîte": "num_boite",
        "LOCALISATION_CNJ": "localisation_cnj",
        "MECANISME (cf colonne A)": "mecanisme1",
        "Unnamed: 14": "mecanisme2",
        "Unnamed: 15": "mecanisme3",
        "Collection d'origine (cf colonne C)": "collection_origine",
        "Etat": "etat", 
        "Code barre": "code_barre"
    })[[
        "id_jeu", "titre_jeu", "References", "auteurs", "date_parution_debut", "date_parution_fin", "information_date", "version", "nombre_joueurs", "age_min", "mots_cles","num_boite", "localisation_cnj", "mecanisme1", "mecanisme2", "mecanisme3", "collection_origine", "etat", "code_barre" 
    ]]

    # Validation de l'id_jeu
    def validation_id(jeu_id):
        try:
            val = int(jeu_id)
            return val if val > 0 
            else None  
        except (ValueError, TypeError):
            return None

    jeux["id_jeu"] = jeux["id_jeu"].apply(validation_id)


    # Validation des dates
    def validation_annee(annee):
        try:
            annee = int(annee)
            return anne if 1000 <= annee <= 2100
            else None
        except (ValueError, TypeError):
            return None

    jeux["date_parution_debut"] = jeux["date_parution_debut"].apply(validation_annee)
    jeux["date_parution_fin"] = jeux["date_parution_fin"].apply(validation_annee)

    jeux["id_jeu"] = excelToId(data)
    jeux["titre_jeu"] = excelToTitre(data)
    jeux["auteurs"] = excelToAuteur(data)
    jeux["date_parution_debut"] = excelToDateParutionDebut(data)
    jeux["date_parution_fin"] = excelToDateParutionFin(data)
    jeux["information_date"] = excelToInformation(data)
    jeux["version"] = excelToVersion(data)
    jeux["nombre_joueurs"] = excelToNbJoueurs(data)
    jeux["age_min"] = excelToAge(data)
    jeux["mots_cles"] = excelToMotsCles(data)
    jeux["num_boite"] = excelToNumBoite(data)
    jeux["localisation_cnj"] = excelToLocalisation(data)
    
    # Nettoyage des mécanismes
    mecas = excelToMecanisme(data)
    jeux["mecanisme1"], jeux["mecanisme2"], jeux["mecanisme3"] = 
        mecas["MECANISME (cf colonne A)"], 
        mecas["Unnamed: 14"], 
        mecas["Unnamed: 15"]
    
    jeux["collection_origine"] = excelToCollectionOrigine(data)
    jeux["etat"] = excelToEtat(data)
    jeux["code_barre"] = excelToCodeBarre(data)


    #optionnel
    #jeux_trie = excelTrieParId(jeux)
    
    # Export des données nettoyées
    file_path = "./data/inventaire_perso.xlsx" # en fonction de votre emplacement
    jeux.to_excel(file_path, index=False)
    jeux.to_csv('C:/ProgramData/MySQL/MySQL Server 9.1/Uploads/inventaire.csv', index=False)
    print(f"\nle fichier a été sauvegardé ici : {file_path}")

    

path = "../inventaire_extrait.xlsx" # en fonction de l'emplacement du fichier

data = pd.read_excel(path)
nettoyer_excel(data)
