import pandas as pd


def excelToId(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne tout les identifiants.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'Unnamed: 0'
    """
    return data["Unnamed: 0"]

def excelToTitre(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne tout les titres.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'TITRE'
    """
    return data["TITRE"]

def excelToRef(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne toutes les références.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'REFERENCES (éditeur/distributeur)'
    """
    return data["REFERENCES (éditeur/distributeur)"]

def excelToAuteur(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne tout les auteurs.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'AUTEURS'
    """
    return data["AUTEURS"]

def excelToDateParutionDebut(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne toutes les dates de début de parution.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'DATE DE PARUTION DEBUT'
    """
    return data["DATA DE PARUTION DEBUT"]

def excelToDateParutionFin(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne toutes les dates de fin de parution.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'DATE DE PARUTION FIN'
    """
    return data["DATA DE PARUTION FIN"]

def excelToInformation(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne toutes les informations.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'INFORMATION DATA'
    """
    return data["INFORMATION DATA"]

def excelToVersion(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne toutes les versions.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'VERSION'
    """
    return data["VERSION"]

def excelToNbJoueurs(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne toutes les nombres de joueurs

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'NOMBRE DE JOUEURS'
    """
    return data["NOMBRE DE JOUEURS"]

def excelToAge(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne tout les âges.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'AGE INDIQUE (cf colonne B)'
    """
    return data["AGE INDIQUE (cf colonne B)"]

def excelToMotsCles(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne tout les mots clés.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'MOTS CLES'
    """
    return data["MOTS CLES"]

def excelToNumBoite(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne tout les numéros de boîte.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'N Boîte'
    """
    return data["N Boîte"]

def excelToLocalisation(data: pd.DataFrame) -> pd.DataFrame:
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
    Retourne tout les mécanismes.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'MECANISME (cf colonne A)' et aussi les deux colonnes à côtés de lui
    """
    index_meca = data.columns.get_loc("MECANISME (cf colonne A)")
    return data.iloc[:, [index_meca, index_meca+1, index_meca+2]]

def excelToCollectionOrigine(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne toutes les collections d'origine.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'Collecction d'origine (cf colonne C)'
    """
    return data["Collection d'origine (cf colonne C)"]

def excelToEtat(data: pd.DataFrame) -> pd.DataFrame:
    """
    Retourne tout les états.

    Args:
        data (pd.DataFrame): DataFrame qui contient les données excel

    Returns:
        pd.Series: une série pandas qui contient les valeurs de la colonne 'Etat'
    """
    return data["Etat"]

def excelToCodeBarre(data: pd.DataFrame) -> pd.DataFrame:
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