import pandas as pd
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

def nettoyer_excel(data: pd.DataFrame) -> pd.DataFrame:
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

    # Supprimer les doublons
    data_sans_doublons = data.drop_duplicates()

    # Gérer les valeurs manquantes -> remplace les cases vides ou espaces
    for colonne in data_sans_doublons.columns:
        # on vérifie si c'est une colonne de type TEXT
        if data_sans_doublons[colonne].dtype == 'object': 
            data_sans_doublons[colonne] = data_sans_doublons[colonne].apply(remplacer_chaine_vide)

    # Enlever les espaces en trop dans les colonnes de texte
    for colonne in data_sans_doublons.columns:
        if data_sans_doublons[colonne].dtype == 'object':
            data_sans_doublons[colonne] = data_sans_doublons[colonne].str.strip()

    return data_sans_doublons