import pandas as pd

"""
Fichier qui me sert juste pour des tests en local.
"""

def enleve_espace(chaine: str) -> str:
    """
    Enlève les espaces au début et à la fin d'une chaîne.
    Si la chaîne est ou vide ou 'NR' on retourne None.

    Args:
        chaine (str): La chaîne à nettoyer

    Returns:
        str: La valeur nettoyée
    """
    chaine = str(chaine).strip() # Enlever les espaces début et fin
    if chaine == '' or chaine == 'NR':
        return None
    return chaine


def excelToId(data: pd.DataFrame) -> pd.Series:
    """
    Retourne tous les identifiants après nettoyage.
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les identifiants
    """
    ids = data["Unnamed: 0"].apply(enleve_espace)
    ids = ids[ids.notna()] # Supprime les valeurs NaN
    return ids


def excelToTitre(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les titres après nettoyage (strip, enlever les vides).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les titres
    """
    titres = data["TITRE"]
    titres_clean = titres.apply(enleve_espace)
    return titres_clean


def excelToRef(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les références après nettoyage (strip, vérifier les vides).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les références
    """
    refs = data["REFERENCES (éditeur/distributeur)"]
    titres_clean = refs.apply(enleve_espace)
    return titres_clean


def excelToAuteur(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les auteurs après nettoyage (strip, 'NR' devient None).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les auteurs
    """
    auteurs = data["AUTEURS"]
    auteurs_clean = auteurs.apply(enleve_espace)
    return auteurs_clean


def excelToDateParutionDebut(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les dates de début de parution après nettoyage (strip, vérifier les dates négatives).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les dates de début de parution
    """
    dates_debut = data["DATE DE PARUTION DEBUT"]

    # Nettoyer les dates
    date_debut_clean = []
    for date in dates_debut:
        date = enleve_espace(date)
        if date == '' or date is None or not date.isdigit() or int(date) < 0:
            date_debut_clean.append(None)  # None si date vide ou négatif
        else:
            date_debut_clean.append(date)
    
    return pd.Series(date_debut_clean)


def excelToDateParutionFin(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les dates de fin de parution après nettoyage (strip, vérifier les dates négatives).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les dates de fin de parution
    """
    dates_fin = data["DATE DE PARUTION FIN"].apply(enleve_espace)
    
    # Nettoyer les dates
    date_debut_fin = []
    for date in dates_fin:
        date = enleve_espace(date)
        if date == '' or date is None or not date.isdigit() or int(date) < 0:
            date_debut_fin.append(None)  # None si date vide ou négatif
        else:
            date_debut_fin.append(date)
    
    return pd.Series(date_debut_fin)

# A FAIRE MAIS BIZARRE
def excelToInformation(data: pd.DataFrame) -> pd.Series:
    """
    Retourne toutes les informations.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'INFORMATION DATA'
    """
    return data["INFORMATION DATA"]


def excelToVersion(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les versions après nettoyage (strip, vider les vides).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les versions
    """
    versions = data["VERSION"]
    
    # Nettoyer les versions
    versions_clean = versions.apply(enleve_espace)
    return versions_clean

# A FAIRE MAIS BIZARRE AUSSI
def excelToNbJoueurs(data: pd.DataFrame) -> pd.Series:
    """
    Retourne toutes les nombres de joueurs

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'NOMBRE DE JOUEURS'
    """
    return data["NOMBRE DE JOUEURS"]

# DECIDEMMENT TOUT EST BIZARRE
def excelToAge(data: pd.DataFrame) -> pd.Series:
    """
    Retourne tout les âges.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'AGE INDIQUE (cf colonne B)'
    """
    return data["AGE INDIQUE (cf colonne B)"]


def excelToMotsCles(data: pd.DataFrame) -> pd.Series:
    """
    Retourne les mots-clés après nettoyage (mettre en lowercase).
    
    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
    
    Returns:
        pd.Series: une série pandas nettoyée contenant les mots-clés
    """
    mots_cles = data["MOTS CLES"]
    
    mots_cles_clean = []
    
    for x in mots_cles:
        # Enlever les espaces et mettre en lower
        valeur_clean = str(x).strip().lower()
        mots_cles_clean.append(valeur_clean)

    return pd.Series(mots_cles_clean)
    

# QUE FAIRE DE CA ?
def excelToNumBoite(data: pd.DataFrame) -> pd.Series:
    """
    Retourne tout les numéros de boîte.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'N Boîte'
    """
    return data["N Boîte"]

# A FAIRE EN FONCTION DU CLIENT
def excelToLocalisation(data: pd.DataFrame) -> pd.Series:
    """
    Retourne toutes les localisations au CNJ.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'LOCALISATION_CNJ'
    """
    return data["LOCALISATION_CNJ"]


def excelToMecanisme(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne tous les mécanismes après nettoyage des valeurs.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.DataFrame: un DataFrame contenant les trois colonnes de mécanisme nettoyées
    """
    # Trouver la position de la colonne "MECANISME (cf colonne A)"
    index_meca = data.columns.get_loc("MECANISME (cf colonne A)")
    
    # Sélectionner les 3 colonnes des mécanismes
    mecanismes = data.iloc[:, [index_meca, index_meca + 1, index_meca + 2]]
    
    # Appliquer le nettoyage sur chaque colonne
    for col in mecanismes.columns:
        mecanismes[col] = mecanismes[col].apply(enleve_espace)
    
    return mecanismes


# A FAIRE
def excelToCollectionOrigine(data: pd.DataFrame) -> pd.Series:
    """
    Retourne toutes les collections d'origine.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'Collecction d'origine (cf colonne C)'
    """
    return data["Collection d'origine (cf colonne C)"]

# A FAIRE
def excelToEtat(data: pd.DataFrame) -> pd.Series:
    """
    Retourne tout les états.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'Etat'
    """
    return data["Etat"]

# A FAIRE OU A OUBLIER
def excelToCodeBarre(data: pd.DataFrame) -> pd.Series:
    """
    Retourne tout les codes barres.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'Code barre'
    """
    return data["Code barre"]


def excelGetLine(data: pd.DataFrame, indice: int) -> pd.Series:
    """
    Retourne une seule ligne du fichier.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel
        indice (int): Indice de la ligne
        
    Returns:
        pd.Series: une série pandas qui contient toutes les valeurs de la ligne choisit
    """
    return data.iloc[indice]