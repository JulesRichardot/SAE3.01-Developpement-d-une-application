import pandas as pd


def excelToId(data):
    """
    Retourne les identifiants de chaque ligne.

    Args:
        data: les lignes du fichiers excel

    Returns:
        int: l'id correspondant à la ligne
    """
    return data["Unnamed: 0"]

def excelToTitre(data):
    """
    Retourne les titres de chaque ligne.

    Args:
        data: les lignes du fichiers excel

    Returns:
        int: l'id correspondant à la ligne
    """
    return data["TITRE"]

def excelToRef(data):
    return data["REFERENCES (éditeur/distributeur)"]

def excelToAuteur(data):
    return data["AUTEURS"]

def excelToDateParutionDebut(data):
    return data["DATA DE PARUTION DEBUT"]

def excelToDateParutionFin(data):
    return data["DATA DE PARUTION FIN"]

def excelToInformation(data):
    return data["INFORMATION DATA"]

def excelToVersion(data):
    return data["VERSION"]

def excelToNbJoueurs(data):
    return data["NOMBRE DE JOUEURS"]

def excelToAge(data):
    return data["AGE INDIQUE (cf colonne B)"]

def excelToMotsCles(data):
    return data["MOTS CLES"]

def excelToNumBoite(data):
    return data["N Boîte"]

def excelToLocalisation(data):
    return data["LOCALISATION_CNJ"]

def excelToMecanisme(data):
    index_meca = data.columns.get_loc("MECANISME (cf colonne A)")
    return data.iloc[:, [index_meca, index_meca+1, index_meca+2]]

def excelToCollectionOrigine(data):
    return data["Collection d'origine (cf colonne C)"]

def excelToEtat(data):
    return data["Etat"]

def excelToCodeBarre(data):
    return data["Code barre"]

def excelGetLine(data, i):
    return data.iloc[i]