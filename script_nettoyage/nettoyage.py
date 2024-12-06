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

    # Il faudrait utiliser les fonctions de utils pour nettoyer (plus lisible mais sûrement pas utile)

    return None