from utils import *

def remplacer_chaine_vide(chaine: str) -> bool:
    """
    Remplace par None les chaînes vides ou ceux qui sont composées d'espaces

    Args:
        chaine (str): La chaîne à vérifier
    
    Returns:
        None ou la valeure originale
    """
    if isinstance(chaine, str) and chaine.strip() == '':
        return None
    return chaine

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

    jeux = data.rename(columns={
        "Unnamed: 0": "id_jeu",
        "TITRE": "titre_jeu",
        "DATE DE PARUTION DEBUT": "date_parution_debut",
        "DATE DE PARUTION FIN": "date_parution_fin",
        "AGE INDIQUE (cf colonne B)": "age_min",
        "MOTS CLES": "mots_cles",
        "VERSION": "version"
    })[[
        "id_jeu", "titre_jeu", "date_parution_debut", "date_parution_fin",
        "nb_joueur_min", "nb_joueur_max", "age_min", "mots_cles", "version"
    ]]

    # Il faudrait utiliser les fonctions de utils pour nettoyer (plus lisible mais sûrement pas utile)

    return None
